<?php

namespace App\Infra\Story;

use App\Infra\Factory\PublisherFactory;
use Zenstruck\Foundry\Story;

final class DefaultPublishersStory extends Story
{
    /**
     * @return void
     */
    public function build(): void
    {
        PublisherFactory::createMany(10);
    }
}
