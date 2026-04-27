<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class GeminiService
{
    protected string $apiKey;
    protected string $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    public function generateSalesPage(array $productData): array
    {
        $prompt = $this->buildPrompt($productData);

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(60)->post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature'     => 0.8,
                    'maxOutputTokens' => 4000,
                ],
            ]);

            if ($response->failed()) {
                throw new Exception('Gemini API error: ' . $response->body());
            }

            $content = $response->json('candidates.0.content.parts.0.text');

            if (!$content) {
                throw new Exception('Empty response from Gemini API');
            }

            return $this->parseResponse($content);

        } catch (Exception $e) {
            throw new Exception('Failed to generate sales page: ' . $e->getMessage());
        }
    }

    private function buildPrompt(array $data): string
    {
        return <<<PROMPT
You are an expert copywriter and marketing specialist. Generate a complete, persuasive sales page for the following product/service.

PRODUCT INFORMATION:
- Product Name: {$data['product_name']}
- Description: {$data['description']}
- Key Features: {$data['key_features']}
- Target Audience: {$data['target_audience']}
- Price: {$data['price']}
- Unique Selling Points: {$data['unique_selling_points']}
- Tone: {$data['tone']}

Generate a complete sales page with the following sections. Return ONLY valid JSON, no markdown, no explanation, no code blocks:

{
  "headline": "compelling main headline",
  "sub_headline": "supporting sub-headline",
  "hero_description": "2-3 sentences hero description",
  "benefits": [
    {"title": "benefit title", "description": "benefit description", "icon": "emoji"}
  ],
  "features": [
    {"title": "feature title", "description": "feature description"}
  ],
  "social_proof": [
    {"name": "Customer Name", "role": "Job Title", "testimonial": "testimonial text", "rating": 5}
  ],
  "pricing": {
    "display_price": "formatted price",
    "original_price": "original price if discount",
    "currency": "IDR or USD",
    "billing": "one-time or /month",
    "includes": ["what's included 1", "what's included 2"]
  },
  "cta": {
    "primary": "primary CTA button text",
    "secondary": "secondary CTA text"
  },
  "faq": [
    {"question": "FAQ question", "answer": "FAQ answer"}
  ]
}
PROMPT;
    }

    private function parseResponse(string $content): array
    {
        $clean = preg_replace('/```json|```/i', '', $content);
        $clean = trim($clean);

        $parsed = json_decode($clean, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Failed to parse AI response: ' . json_last_error_msg());
        }

        return $parsed;
    }
}