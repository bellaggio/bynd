<?php

namespace App\Infra\Story;

use App\Infra\Factory\AuthorFactory;
use Zenstruck\Foundry\Story;

final class DefaultAuthorsStory extends Story
{
    public function build(): void
    {
        AuthorFactory::createMany(10);
    }
}
