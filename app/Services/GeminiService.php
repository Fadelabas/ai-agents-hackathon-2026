<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    private string $apiKey;
    private string $endpoint;
    private string $model;

    public function __construct()
    {
        $this->apiKey   = config('services.gemini.key');
        $this->model    = config('services.gemini.model');
        $this->endpoint = config('services.gemini.endpoint');
    }

    /**
     * Send conversation history to Gemini.
     * Returns either a question string or a completed order array.
     */
    public function chat(array $history): array
    {
        $url = $this->endpoint . $this->model . ':generateContent?key=' . $this->apiKey;

        $payload = [
            'system_instruction' => [
                'parts' => [['text' => $this->getSystemPrompt()]]
            ],
            'contents' => $this->formatHistory($history),
            'generationConfig' => [
                'temperature'     => 0.3,
                'maxOutputTokens' => 500,
            ],
        ];

        try {
            $response = Http::timeout(90)
                ->post($url, $payload);

            if ($response->failed()) {
                Log::error('Gemini API error', ['status' => $response->status(), 'body' => $response->body()]);
                return $this->errorResponse('Service temporarily unavailable. Please try again.');
            }

            $text = $response->json('candidates.0.content.parts.0.text') ?? '';
            return $this->parseResponse($text);

        } catch (\Exception $e) {
            Log::error('Gemini exception', ['message' => $e->getMessage()]);
            return $this->errorResponse('Connection timeout. Please try again.');
        }
    }

    /**
     * Parse Gemini response.
     * Returns type=question or type=order_data.
     */
   private function parseResponse(string $text): array
{
    $text = trim($text);

    // Strip markdown code fences if present
    $cleaned = preg_replace('/^```(?:json)?\s*/i', '', $text);
    $cleaned = preg_replace('/\s*```$/', '', $cleaned);
    $cleaned = trim($cleaned);

    // Try to decode as JSON
    $decoded = json_decode($cleaned, true);

    if (
        json_last_error() === JSON_ERROR_NONE &&
        is_array($decoded) &&
        !empty($decoded['task_type']) &&
        !empty($decoded['area_text']) &&
        !empty($decoded['exact_address']) &&
        !empty($decoded['customer_phone'])
    ) {
        return [
            'type' => 'order_data',
            'data' => [
                'task_type'      => $decoded['task_type'],
                'area_text'      => $decoded['area_text'],
                'exact_address'  => $decoded['exact_address'],
                'customer_phone' => $decoded['customer_phone'],
            ],
        ];
    }

    // Otherwise treat as conversational message
    return [
        'type'    => 'question',
        'message' => $text,
    ];
}
    /**
     * Format conversation history for Gemini API.
     */
    private function formatHistory(array $history): array
    {
        return array_map(function ($message) {
            return [
                'role'  => $message['role'],
                'parts' => [['text' => $message['content']]],
            ];
        }, $history);
    }

    /**
     * Return error response.
     */
    private function errorResponse(string $message): array
    {
        return [
            'type'    => 'question',
            'message' => $message,
        ];
    }

    /**
     * The system prompt — defines AI behavior.
     * This is the most important text in the project.
     */
    private function getSystemPrompt(): string
    {
        return <<<PROMPT
You are Jibli, an AI-powered delivery dispatch assistant for Lebanon.
Your ONLY job is to collect exactly 4 pieces of information from the customer through natural conversation.

REQUIRED FIELDS:
1. task_type — what service they need
2. area_text — delivery area (raw text, any spelling)
3. exact_address — specific landmark or address
4. customer_phone — Lebanese mobile number

TASK TYPES (classify from customer message):
- medicine_delivery: dawa, daweh, دوا, medication, medicine, médicament, pharmacie
- food_delivery: akle, اكل, food, manger, pizza, burger, restaurant
- grocery_delivery: 7ajiyat, حاجيات, groceries, supermarket, épicerie
- document_delivery: wara2a, ورقة, document, papier, papers
- shop_delivery: shi mn ma7al, شي من المحل, from shop, from store
- taxi_request: sayyara, سيارة, taxi, ride, voiture, transport
- other: anything that does not fit above

CONVERSATION RULES:
- Respond in the SAME language the customer used (Arabic, French, English, or Franco-Arabic)
- Ask ONE missing question at a time
- Ask in this order: task_type → area_text → exact_address → customer_phone
- Be friendly, short, and natural
- Accept area names in any spelling or language
- Accept phone numbers in any Lebanese format (03, 70, 71, 76, 78, 79, 81)
- Never calculate prices
- Never mention prices
- Never suggest drivers
- Never make business decisions

FRANCO-ARABIC EXAMPLES YOU MUST UNDERSTAND:
- "jibli dawa mn saydali" = medicine delivery
- "bade taxi la beirut" = taxi request
- "jibli akle mn 3and ammo hassan" = food delivery
- "wassel wara2a 3a dekwaneh" = document delivery
- "7azmieh", "hzerta", "dkwaneh", "jdide", "3ntlyas" = area names
- "3and el madrase", "2eddem el bank", "hal el jami3a" = addresses

LEBANESE AREAS YOU WILL HEAR (accept all spellings):
Beirut areas: Hamra, Achrafieh, Verdun, Badaro, Gemmayzeh, Raouche, Downtown
Metn areas: Fanar, Dekwaneh, Jdeideh, Antelias, Zalka, Dora, Sin El Fil, Bourj Hammoud, Bauchrieh, Mkalles, Mansourieh, Ain Saadeh, Roumieh, Jal El Dib, Beit Mery, Broumana
Baabda areas: Hazmieh, Hadath, Baabda, Choueifat, Khalde, Kfarchima
Kesrouan areas: Jounieh, Dbayeh, Kaslik, Zouk, Rabieh, Faraya
Bekaa areas: Zahleh, Zahle, Hazerta, Chtaura, Bar Elias, Baalbek, Hermel, Saadnayel, Taanayel, Riyaq, Terbol, Taalabaya, Qabb Elias, Jdita
North: Tripoli, Batroun, Jbeil, Zgharta, Bcharre
South: Sidon, Saida, Tyre, Sour, Nabatieh, Bint Jbeil

OUTPUT STEP:
When you have collected ALL 4 fields, return ONLY this exact JSON with NO extra text, NO explanation, NO summary:
{
  "task_type": "medicine_delivery",
  "area_text": "hazmieh",
  "exact_address": "3and el madrase",
  "customer_phone": "03xxxxxx"
}

IMPORTANT:
- Return the JSON immediately when all 4 fields are known
- Do NOT ask the customer to confirm
- Do NOT mention price
- Do NOT say anything before or after the JSON
- The system will handle price calculation and confirmation separately
PROMPT;
    }
}