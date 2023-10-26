<?php

namespace App\Infra\DataFixtures;

use App\Infra\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $book = new Book();
            $book->setName('Sample Book ' . $i);
            $book->setAuthor($i);
            $book->setPublisher($i);
            $manager->persist($book);
        }

        $manager->flush();
        $manager->flush();
    }
}
