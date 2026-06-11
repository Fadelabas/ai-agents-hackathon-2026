<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Str;

class OrderService
{
    public function __construct(
        private ZoneResolverService $zoneResolver,
        private PriceLookupService  $priceLookup,
    ) {}

    /**
     * Resolve area + calculate price from AI extracted data.
     * Returns price info to show customer BEFORE creating order.
     */
    public function prepareOrder(array $aiData): array
    {
        // Resolve geography
        $geo = $this->zoneResolver->resolve($aiData['area_text']);

        // Calculate price
        $pricing = $this->priceLookup->lookup(
            $geo['area_id'],
            $geo['district_id'],
            $geo['governorate_id']
        );

        return [
            'ai_data' => $aiData,
            'geo'     => $geo,
            'pricing' => $pricing,
        ];
    }

    /**
     * Create the order after customer confirms price.
     */
 public function createOrder(array $prepared): Order
{
    $aiData  = $prepared['ai_data'];
    $geo     = $prepared['geo'];
    $pricing = $prepared['pricing'];
    $token   = $prepared['token'] ?? \Illuminate\Support\Str::random(40);

    return Order::create([
        'session_token'     => $token,
        'customer_phone'    => $aiData['customer_phone'],
        'original_message'  => $aiData['area_text'],
        'task_type'         => $aiData['task_type'],
        'area_text'         => $aiData['area_text'],
        'area_id'           => $geo['area_id'],
        'area_name'         => $geo['area_name'],
        'district_id'       => $geo['district_id'],
        'district_name'     => $geo['district_name'],
        'governorate_id'    => $geo['governorate_id'],
        'governorate_name'  => $geo['governorate_name'],
        'resolution_method' => $geo['resolution_method'],
        'exact_address'     => $aiData['exact_address'],
        'price'             => $pricing['price'],
        'price_source'      => $pricing['price_source'],
        'status'            => Order::STATUS_PENDING,
    ]);
}
    /**
     * Build the price confirmation message shown to customer.
     */
    public function buildConfirmationMessage(array $prepared): string
    {
        $price    = $prepared['pricing']['price'];
        $area     = $prepared['geo']['area_name']
                    ?? $prepared['ai_data']['area_text'];
        $taskMap  = [
            'medicine_delivery' => '💊 Medicine Delivery',
            'food_delivery'     => '🍔 Food Delivery',
            'grocery_delivery'  => '🛒 Grocery Delivery',
            'document_delivery' => '📄 Document Delivery',
            'shop_delivery'     => '🛍️ Shop Delivery',
            'taxi_request'      => '🚖 Taxi Request',
            'other'             => '📦 Delivery',
        ];

        $taskLabel = $taskMap[$prepared['ai_data']['task_type']] ?? '📦 Delivery';
        $address   = $prepared['ai_data']['exact_address'];

        return "✅ Order Summary:\n"
            . "• Service: {$taskLabel}\n"
            . "• Area: {$area}\n"
            . "• Address: {$address}\n"
            . "• Delivery Fee: \${$price}\n\n"
            . "Reply *yes* to confirm or *no* to cancel.";
    }
}