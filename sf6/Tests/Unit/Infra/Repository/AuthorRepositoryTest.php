<?php

namespace App\Tests\Unit\Infra\Repository;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

use App\Infra\Entity\Author;
use App\Infra\Factory\AuthorFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class AuthorRepositoryTest extends ApiTestCase
{

    use ResetDatabase,Factories;

    /**
     * @var array
     */
    private array $authors;
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

        $this->authors = AuthorFactory::createMany(10);
        parent::setUp();
    }

    /**
     * @return void
     * @throws \Doctrine\ORM\Exception\NotSupported
     */
    public function testSearchByNameShouldReturnAuthorEntity(): void
    {
        $response = $this->entityManager
            ->getRepository(Author::class)
            ->findByName ($this->authors[0]->getName())
        ;
        $this->assertSame($this->authors[0]->getName(), $response->getName());
        $this->assertInstanceOf(Author::class, $response);
    }

    /**
     * @return void
     * @throws \Doctrine\ORM\Exception\NotSupported
     */
    public function testSearchByNameShouldReturnNullWhenNotFound(): void
    {
        $response = $this->entityManager
            ->getRepository(Author::class)
            ->findByName ("Testing")
        ;
        $this->assertNull($response);
    }
}