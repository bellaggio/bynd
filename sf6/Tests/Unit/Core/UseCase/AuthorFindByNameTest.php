<?php

namespace App\Tests\Unit\Core\UseCase;

use App\Core\UseCase\AuthorFindByName;
use App\Infra\Entity\Author;
use App\Infra\Repository\AuthorRepository;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

class AuthorFindByNameTest extends TestCase
{
    use Factories;
    protected AuthorRepository $repositoryMock;
    protected AuthorFindByName $useCase;
    public function setUp(): void
    {
        $this->repositoryMock = $this->getMockBuilder(AuthorRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['findByName'])
            ->getMock();

        parent::setUp();

        $this->useCase = new AuthorFindByName($this->repositoryMock);
    }

    public function testShouldReturnAuthorEntityByNameWhenFound():void
    {
        $author = new Author();
        $author->setName("Petter");
        $this->repositoryMock->expects(self::once())->method('findByName')->willReturn($author);

        $response = $this->useCase->handler('Petter');

        $this->assertTrue($response instanceof Author);
        $this->assertEquals('Petter', $response->getName());
    }

    public function testShouldReturnNullByNameWhenNotFound():void
    {
        $this->repositoryMock->expects(self::once())->method('findByName')->willReturn(null);

        $response = $this->useCase->handler('Petter');
        $this->assertNull($response);
    }
}