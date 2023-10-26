<?php

namespace App\Core\Adapters;

use App\Infra\Entity\Author;


interface AuthorRepositoryInterface
{
    public function findByName(string $name): ?Author;
}