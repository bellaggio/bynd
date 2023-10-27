<?php

namespace App\Tests\Unit\Core\UseCase;

use App\Core\UseCase\AuthorFindByName;
use App\Core\UseCase\PublisherFindByName;
use App\Infra\Entity\Author;
use App\Infra\Entity\Publisher;
use App\Infra\Repository\AuthorRepository;
use App\Infra\Repository\PublisherRepository;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

class PublisherFindByNameTest extends TestCase
{
    use Factories;
    protected PublisherRepository $repositoryMock;
    protected PublisherFindByName $useCase;
    public function setUp(): void
    {
        $this->repositoryMock = $this->getMockBuilder(PublisherRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['findByName'])
            ->getMock();

        parent::setUp();

        $this->useCase = new PublisherFindByName($this->repositoryMock);
    }

    public function testShouldReturnPublisherEntityByNameWhenFound(){
        $publisher = new Publisher();
        $publisher->setName("Petter");
        $this->repositoryMock->expects(self::once())->method('findByName')->willReturn($publisher);

        $response = $this->useCase->handler('Petter');
        $this->assertTrue($response instanceof Publisher);
        $this->assertEquals('Petter', $response->getName());
    }

    public function testShouldReturnNullByNameWhenNotFound(){

        $this->repositoryMock->expects(self::once())->method('findByName')->willReturn(null);

        $response = $this->useCase->handler('Petter');
        $this->assertNull($response);
    }
}