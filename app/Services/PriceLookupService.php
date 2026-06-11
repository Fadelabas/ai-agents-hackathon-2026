<?php

namespace App\Services;

use App\Models\DeliveryPrice;

class PriceLookupService
{
    /**
     * Lookup delivery price using waterfall:
     * area → district → governorate → default
     */
    public function lookup(
        ?int $areaId,
        ?int $districtId,
        ?int $governorateId
    ): array {

        // ── Level 1: Area price ───────────────────────────────
        if ($areaId) {
            $price = DeliveryPrice::where('pricing_level', 'area')
                ->where('area_id', $areaId)
                ->first();

            if ($price) {
                return $this->buildResult($price->price, 'area');
            }
        }

        // ── Level 2: District price ───────────────────────────
        if ($districtId) {
            $price = DeliveryPrice::where('pricing_level', 'district')
                ->where('district_id', $districtId)
                ->first();

            if ($price) {
                return $this->buildResult($price->price, 'district');
            }
        }

        // ── Level 3: Governorate price ────────────────────────
        if ($governorateId) {
            $price = DeliveryPrice::where('pricing_level', 'governorate')
                ->where('governorate_id', $governorateId)
                ->first();

            if ($price) {
                return $this->buildResult($price->price, 'governorate');
            }
        }

        // ── Level 4: Default fallback — never null ────────────
        $default = DeliveryPrice::where('pricing_level', 'default')
            ->first();

        return $this->buildResult($default->price, 'default');
    }

    /**
     * Build price result array.
     */
    private function buildResult(float $price, string $source): array
    {
        return [
            'price'        => round($price, 2),
            'price_source' => $source,
        ];
    }
}