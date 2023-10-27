<?php

namespace App\Core\UseCase;

use App\Core\Adapters\BookRepositoryInterface;
use App\Infra\Entity\Author;
use App\Infra\Entity\Book;
use App\Infra\Entity\Publisher;

class CreateUpdateBook
{
    public function __construct(protected BookRepositoryInterface $bookRepository)
    {
    }

    /**
     * @param array $data
     * @param Author $hasAuthor
     * @param Publisher $hasPublisher
     * @return Book
     */
    public function handler(array $data, Author $hasAuthor, Publisher $hasPublisher): Book
    {
        if (isset($data['id'])) {
            return $this->bookRepository->update($data['id'], $data, $hasAuthor, $hasPublisher);
        }
        return $this->bookRepository->create($data, $hasAuthor, $hasPublisher);
    }
}