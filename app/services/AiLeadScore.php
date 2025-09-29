<?php

namespace App\Services;

use GuzzleHttp\Client;

class AiLeadScore
{
    protected $client;
    protected $apiToken;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiToken = env('HUGGINGFACE_API_TOKEN');
    }

    public function classify(string $text): array
    {
        try {
            $response = $this->client->post(
                'https://api-inference.huggingface.co/models/facebook/bart-large-mnli',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->apiToken,
                        'Content-Type'  => 'application/json',
                    ],
                    'json' => [
                        'inputs' => $text,
                        'parameters' => [
                            'candidate_labels' => ['High', 'Medium', 'Low'],
                        ],
                    ],
                ]
            );

            $result = json_decode($response->getBody(), true);

            $labels = $result['labels'] ?? [];
            $scores = $result['scores'] ?? [];

            if (empty($labels) || empty($scores)) {
                return [
                    'score' => null,
                    'category' => 'Error: No result',
                ];
            }

            // Best match
            $category = $labels[0];  
            $score = (int) round($scores[0] * 100);

            return [
                'score' => $score,
                'category' => $category,
            ];
        } catch (\Exception $e) {
            return [
                'score' => null,
                'category' => 'Error: ' . $e->getMessage(),
            ];
        }
    }
}
