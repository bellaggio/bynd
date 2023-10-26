<?php

namespace App\Infra\DataFixtures;

use App\Infra\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $author = new Author();
            $author->setName('Petter' . $i);
            $manager->persist($author);
        }
        $manager->flush();
    }
}
