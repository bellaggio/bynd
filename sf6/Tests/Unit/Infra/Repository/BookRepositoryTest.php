<?php

namespace App\Tests\Unit\Infra\Repository;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Infra\Entity\Book;
use App\Infra\Factory\BookFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class BookRepositoryTest extends ApiTestCase
{
    use ResetDatabase,Factories;

    /**
     * @var array|Book[]|\Zenstruck\Foundry\Proxy[]
     */
    private array $books;
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private \Doctrine\ORM\EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->books = BookFactory::createMany(10);
        parent::setUp();
    }

    /**
     * @return void
     * @throws \Doctrine\ORM\Exception\NotSupported
     */
    public function testSearchByNameShouldReturnBookEntity(): void
    {

        $response = $this->entityManager
            ->getRepository(Book::class)
            ->search($this->books[0]->getName())
        ;
        $this->assertSame($this->books[0]->getName(), $response->getName());
        $this->assertInstanceOf(Book::class, $response);
    }

    /**
     * @return void
     * @throws \Doctrine\ORM\Exception\NotSupported
     */
    public function testSearchByNameShouldReturnNullWhenNotFound(): void
    {

        $response = $this->entityManager
            ->getRepository(Book::class)
            ->search('Petter')
        ;
        $this->assertNull($response);
    }

}