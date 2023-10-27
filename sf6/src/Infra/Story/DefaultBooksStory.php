<?php

namespace App\Infra\Story;

use App\Infra\Factory\BookFactory;
use Zenstruck\Foundry\Story;

final class DefaultBooksStory extends Story
{
    public function build(): void
    {
        BookFactory::createMany(100);
    }
}
