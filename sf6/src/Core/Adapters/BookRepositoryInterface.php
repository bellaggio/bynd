<?php

namespace App\Core\Adapters;

use App\Infra\Entity\Author;
use App\Infra\Entity\Book;
use App\Infra\Entity\Publisher;

interface BookRepositoryInterface
{
    public function create(array $data, Author $hasAuthor, Publisher $hasPublisher): Book;

    public function update(int $id, array $data, Author $hasAuthor, Publisher $hasPublisher): Book;

    public function search(string $name): ?Book;
}