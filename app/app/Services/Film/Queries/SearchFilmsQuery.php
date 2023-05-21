<?php

namespace App\Services\Film\Queries;

class SearchFilmsQuery implements FilmQueryInterface
{
    public function __construct(
        public readonly string $searchTerm,
        public readonly ?int $page = 1
    ) {
    }
}
