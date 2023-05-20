<?

namespace App\Services\Film;

use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Http;

class FilmApiClient implements FilmApiInterface
{
    private string $baseUrl;
    private string $token;

    public function __construct(string $baseUrl, string $token)
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
    }

    public function getTrendingFilmsOfDay(): ?array
    {
        $url = "{$this->baseUrl}/trending/all/day";
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->token}",
            'Accept' => 'application/json',
        ])->get($url, ['language' => 'en-US']);

        if ($response->successful()) return $response->json();


        throw new ApiException('Failed to fetch trending films of the day');
    }

    public function getTrendingFilmsOfMonth(): ?array
    {
        $url = "{$this->baseUrl}/trending/all/week";
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->token}",
            'Accept' => 'application/json',
        ])->get($url, ['language' => 'en-US']);

        if ($response->successful()) {
            return $response->json();
        }

        throw new ApiException('Failed to fetch trending films of the month');
    }

    public function getFilmDetails(int $filmId): ?array
    {
        $url = "{$this->baseUrl}/movie/{$filmId}";
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->token}",
            'Accept' => 'application/json',
        ])->get($url, ['language' => 'en-US']);

        if ($response->successful()) {
            return $response->json();
        }

        throw new ApiException('Failed to fetch film details');
    }
}
