<?php

namespace App\Core\Adapters;

use App\Infra\Entity\Author;
use App\Infra\Entity\Book;
use App\Infra\Entity\Publisher;

interface BookRepositoryInterface
{
    /**
     * @param array $data
     * @param Author $hasAuthor
     * @param Publisher $hasPublisher
     * @return Book
     */
    public function create(array $data, Author $hasAuthor, Publisher $hasPublisher): Book;

    /**
     * @param int $id
     * @param array $data
     * @param Author $hasAuthor
     * @param Publisher $hasPublisher
     * @return Book
     */
    public function update(int $id, array $data, Author $hasAuthor, Publisher $hasPublisher): Book;

    /**
     * @param string $name
     * @return Book|null
     */
    public function search(string $name): ?Book;
}