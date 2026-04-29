<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class GroqService
{
    protected string $apiKey;
    protected string $apiUrl = 'https://api.groq.com/openai/v1/chat/completions';
    protected string $model = 'llama-3.3-70b-versatile';

    public function __construct()
    {
        $this->apiKey = config('services.groq.key');
    }

    public function generateSalesPage(array $productData): array
    {
        $prompt = $this->buildPrompt($productData);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ])->timeout(60)->post($this->apiUrl, [
                'model'       => $this->model,
                'temperature' => 0.8,
                'max_tokens'  => 4000,
                'messages'    => [
                    [
                        'role'    => 'system',
                        'content' => 'You are an expert copywriter. Always respond with valid JSON only. No markdown, no explanation, no code blocks. Just raw JSON.',
                    ],
                    [
                        'role'    => 'user',
                        'content' => $prompt,
                    ],
                ],
            ]);

            if ($response->failed()) {
                throw new Exception('Groq API error: ' . $response->body());
            }

            $content = $response->json('choices.0.message.content');

            if (!$content) {
                throw new Exception('Empty response from Groq API');
            }

            return $this->parseResponse($content);

        } catch (Exception $e) {
            throw new Exception('Failed to generate: ' . $e->getMessage());
        }
    }

    private function buildPrompt(array $data): string
    {
        return <<<PROMPT
Generate a complete persuasive sales page for this product. Return ONLY valid JSON, no markdown, no explanation.

PRODUCT INFORMATION:
- Product Name: {$data['product_name']}
- Description: {$data['description']}
- Key Features: {$data['key_features']}
- Target Audience: {$data['target_audience']}
- Price: {$data['price']}
- Unique Selling Points: {$data['unique_selling_points']}
- Tone: {$data['tone']}

Return this exact JSON structure:
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
    "includes": ["included item 1", "included item 2"]
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