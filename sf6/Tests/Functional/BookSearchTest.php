<?php

namespace App\Tests\Functional;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

use App\Infra\Factory\BookFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;
class BookSearchTest extends ApiTestCase
{
    use ResetDatabase, Factories;
    protected $books;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->books = BookFactory::createMany(20);
    }

    /**
     * @return void
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function testShouldReturnBookDataWhenItIsFound():void
    {
        $response = static::createClient()->request('GET', '/api/v1/book/search/'.$this->books[3]->getName());
        $this->assertResponseIsSuccessful();
        $this->assertEquals($response->toArray()['data']['name'], $this->books[3]->getName());
    }

    public function testShouldReturn404WhenBookNotFound():void
    {
        static::createClient()->request('GET', '/api/v1/book/search/Testing');
        $this->assertResponseStatusCodeSame(404);
    }
}