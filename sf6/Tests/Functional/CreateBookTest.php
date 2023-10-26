<?php

namespace App\Tests\Functional;

use App\Tests\BaseTestCase;
use GuzzleHttp\Exception\ClientException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class CreateBookTest extends WebTestCase
{
    public $client;
    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    /**
     * @return void
     */
    public function testCreateShouldReturn200NewBook(){
        $response = $this->client->request('POST','api/v1/book', ['name'=> 'NewBook','ISBN' => 1234]);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @param $data
     * @param $expectation
     * @return void
     */
    public function testCreateShouldGiveException404NewBook($data, $expectation){

        $this->expectException(ClientException::class);
        $response = $this->client->request( "POST",'api/v1/book', $data);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals($expectation,json_decode($response->getBody()->getContents()));
    }

    public function errorProvider(){
        return [
            [
                ['name'=>'Test', 'ISBN'=>1123,'publisher'=>'test'],['xpto']
            ]
        ];
    }
}