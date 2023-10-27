<?php

namespace App\Tests\Unit\Core\UseCase;

use App\Core\UseCase\CreateUpdateBook;
use App\Infra\Entity\Author;
use App\Infra\Entity\Book;
use App\Infra\Entity\Publisher;
use App\Infra\Factory\BookFactory;
use App\Infra\Repository\BookRepository;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

class CreateBookTest extends TestCase
{
    use Factories;
    protected BookRepository $repositoryMock;
    protected CreateUpdateBook $useCase;
    public function setUp(): void
    {
        $this->repositoryMock = $this->getMockBuilder(BookRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['create', 'update'])
            ->getMock();

        parent::setUp();

        $this->useCase = new CreateUpdateBook($this->repositoryMock);
    }

    public function testCreateBookShouldReturnTheBookEntity(): void
    {
        $book = new Book();
        $book->setName('NewBook');
        $book->setDescription('any description valid');
        $book->setPublisher(new Publisher());
        $book->setAuthor(new Author());
        $book->setISBN(1234);

        $this->repositoryMock->expects(self::once())->method('create')->willReturn($book);
        $response = $this->useCase->handler(
            [
                'name'=> 'NewBook',
                'description' => 'any description valid'
            ], new Author(), new Publisher());

        $this->assertEquals($response->getName(), $book->getName());
    }

    public function testUpdateBookShouldReturnTheBookEntityUpdated(): void
    {
        $book = new Book();
        $book->setId(10);
        $book->setName('NewBook Updated');
        $book->setDescription('any description valid');
        $book->setPublisher(new Publisher());
        $book->setAuthor(new Author());
        $book->setISBN(1234);

        $this->repositoryMock->expects(self::once())->method('update')->willReturn($book);
        $response = $this->useCase->handler(
            [
                'id' => 10,
                'name'=> 'NewBook Updated',
                'description' => 'any description valid'
            ], new Author(), new Publisher());

        $this->assertEquals($response->getName(), $book->getName());
    }
}
