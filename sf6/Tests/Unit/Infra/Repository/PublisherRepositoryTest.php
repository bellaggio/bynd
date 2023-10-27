<?php

namespace App\Tests\Unit\Infra\Repository;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

use App\Infra\Entity\Publisher;
use App\Infra\Factory\PublisherFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class PublisherRepositoryTest extends ApiTestCase
{

    use ResetDatabase,Factories;

    /**
     * @var array
     */
    private array $publishers;
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

        $this->publishers = PublisherFactory::createMany(10);
        parent::setUp();
    }

    /**
     * @return void
     * @throws \Doctrine\ORM\Exception\NotSupported
     */
    public function testSearchByNameShouldReturnPublisherEntity(): void
    {
        $response = $this->entityManager
            ->getRepository(Publisher::class)
            ->findByName ($this->publishers[0]->getName())
        ;
        $this->assertSame($this->publishers[0]->getName(), $response->getName());
        $this->assertInstanceOf(Publisher::class, $response);
    }

    /**
     * @return void
     * @throws \Doctrine\ORM\Exception\NotSupported
     */
    public function testSearchByNameShouldReturnNullWhenNotFound(): void
    {
        $response = $this->entityManager
            ->getRepository(Publisher::class)
            ->findByName ("Testing")
        ;
        $this->assertNull($response);
    }
}