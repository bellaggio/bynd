<?php

namespace App\Core\Adapters;

use App\Infra\Entity\Author;

interface AuthorRepositoryInterface
{
    /**
     * @param string $name
     * @return Author|null
     */
    public function findByName(string $name): ?Author;
}
