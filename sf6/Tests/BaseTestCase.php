<?php
namespace App\Tests;

use App\Infra\DataFixtures\PublisherFixture;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\HttpKernel\KernelInterface;

class BaseTestCase extends KernelTestCase
{
    protected static function bootKernel(array $options = []): KernelInterface
    {
        return parent::bootKernel(array_merge([
            'environment' => 'test',
        ], $options));
    }

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
        $this->runMigrations();
        $this->loadFixtures();
    }

    private function runMigrations(): void
    {
        $application = new Application(self::$kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'doctrine:migrations:migrate',
            '--no-interaction' => true,
            '--quiet' => true,
            '--env' => 'test',
        ]);

        $application->run($input);
    }

    private function loadFixtures(): void
    {
        $entityManager = self::getContainer()->get('Doctrine\Persistence\ObjectManager');
        $fixturePublisher = new PublisherFixture();
        $fixturePublisher->load($entityManager);
    }
}
