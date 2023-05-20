<?

namespace App\DTOs;

class FilmDTO
{
    public function __construct(
        public readonly bool $adult,
        public readonly string $backdrop_path,
        public readonly array $belongs_to_collection, // Detailed properties are not represented.
        public readonly int $budget,
        public readonly array $genres, // Detailed properties are not represented.
        public readonly string $homepage,
        public readonly int $id,
        public readonly string $imdb_id,
        public readonly string $original_language,
        public readonly string $original_title,
        public readonly string $overview,
        public readonly float $popularity,
        public readonly string $poster_path,
        public readonly array $production_companies, // Detailed properties are not represented.
        public readonly array $production_countries, // Detailed properties are not represented.
        public readonly string $release_date,
        public readonly int $revenue,
        public readonly int $runtime,
        public readonly array $spoken_languages, // Detailed properties are not represented.
        public readonly string $status,
        public readonly string $tagline,
        public readonly string $title,
        public readonly bool $video,
        public readonly float $vote_average,
        public readonly int $vote_count,
    ) {
    }
}
