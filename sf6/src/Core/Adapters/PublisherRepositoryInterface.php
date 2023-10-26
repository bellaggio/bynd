<?php

namespace App\Core\Adapters;

use App\Infra\Entity\Publisher;

interface PublisherRepositoryInterface
{
    public function findByName(string $name): ?Publisher;
}