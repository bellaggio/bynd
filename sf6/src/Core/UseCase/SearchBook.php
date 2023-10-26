<?php

namespace App\Core\UseCase;

use App\Core\Adapters\BookRepositoryInterface;
use App\Infra\Entity\Book;

class SearchBook
{
    public function __construct(protected BookRepositoryInterface $bookRepository)
    {
    }

    /**
     * @param string $name
     * @return Book|null
     */
    public function handler(string $name): ?Book
    {
        return $this->bookRepository->search($name);
    }
}