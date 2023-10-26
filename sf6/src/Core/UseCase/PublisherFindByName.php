<?php

namespace App\Core\UseCase;

use App\Core\Adapters\PublisherRepositoryInterface;
use App\Infra\Entity\Publisher;

class PublisherFindByName
{
    public function __construct(protected PublisherRepositoryInterface $publisherRepository)
    {
    }

    /**
     * @param string $name
     * @return int
     */
    public function handler(string $name): ?Publisher
    {
        return $this->publisherRepository->findByName($name);
    }
}