<?php

namespace App\Infra\DataFixtures;

use App\Infra\Story\DefaultAuthorsStory;
use App\Infra\Story\DefaultBooksStory;
use App\Infra\Story\DefaultPublishersStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        DefaultAuthorsStory::load();
        DefaultPublishersStory::load();
        DefaultBooksStory::load();
    }
}
