<?php

namespace App\Core\UseCase;

use App\Core\Adapters\AuthorRepositoryInterface;
use App\Infra\Entity\Author;

class AuthorFindByName
{
    public function __construct(protected AuthorRepositoryInterface $authorRepository)
    {
    }

    /**
     * @param string $name
     * @return bool
     */
    public function handler(string $name): ?Author
    {
        return $this->authorRepository->findByName($name);
    }
}