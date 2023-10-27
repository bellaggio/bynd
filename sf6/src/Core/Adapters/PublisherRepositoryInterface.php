<?php

namespace App\Core\Adapters;

use App\Infra\Entity\Publisher;

interface PublisherRepositoryInterface
{
    /**
     * @param string $name
     * @return Publisher|null
     */
    public function findByName(string $name): ?Publisher;
}
