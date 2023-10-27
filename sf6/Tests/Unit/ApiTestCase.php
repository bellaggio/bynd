<?php

namespace App\Tests\Unit;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ApiTestCase extends KernelTestCase
{
    protected $http;

    public function setUp(): void
    {
        $this->http = new \GuzzleHttp\Client(['base_uri' => 'http://localhost:80']);
    }
    public function tearDown(): void
    {
        $this->http = null;
    }
}