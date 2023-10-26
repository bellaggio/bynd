<?php

namespace App\Infra\DataFixtures;

use App\Infra\Entity\Publisher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PublisherFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $author = new Publisher();
            $author->setName('Era' . $i);
            $manager->persist($author);
        }
        $manager->flush();
    }
}
