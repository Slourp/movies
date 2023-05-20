<?php

namespace App\Services\Film;

use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Http;

class FilmApiClient implements FilmApiInterface
{
    public function __construct(
        private string $baseUrl,
        private  string $token
    ) {
    }

    private function sendRequest(string $endpoint, array $params = []): ?array
    {
        $url = "{$this->baseUrl}/$endpoint";
        $headers = [
            'Authorization' => "Bearer {$this->token}",
            'Accept' => 'application/json',
        ];

        $response = Http::withHeaders($headers)
            ->get($url, $params);

        $this->handleResponse($response, $endpoint);

        return $response->json();
    }

    private function handleResponse($response, string $endpoint): void
    {
        if (!$response->successful()) throw new ApiException("Failed to fetch $endpoint");
    }

    public function getTrendingFilmsOfDay(int $page = 1): ?array
    {
        return $this->sendRequest('trending/all/day', [
            'language' => 'en-US',
            'page' => $page,
        ]);
    }

    public function getTrendingFilmsOfMonth(int $page = 1): ?array
    {
        return $this->sendRequest('trending/all/week', [
            'language' => 'en-US',
            'page' => $page,
        ]);
    }

    public function getFilmDetails(int $filmId): ?array
    {
        return $this->sendRequest("movie/{$filmId}", [
            'language' => 'en-US',
        ]);
    }
}
