<?php

namespace App\Infra\Factory;

use App\Infra\Entity\Publisher;
use App\Infra\Repository\PublisherRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Publisher>
 *
 * @method        Publisher|Proxy                     create(array|callable $attributes = [])
 * @method static Publisher|Proxy                     createOne(array $attributes = [])
 * @method static Publisher|Proxy                     find(object|array|mixed $criteria)
 * @method static Publisher|Proxy                     findOrCreate(array $attributes)
 * @method static Publisher|Proxy                     first(string $sortedField = 'id')
 * @method static Publisher|Proxy                     last(string $sortedField = 'id')
 * @method static Publisher|Proxy                     random(array $attributes = [])
 * @method static Publisher|Proxy                     randomOrCreate(array $attributes = [])
 * @method static PublisherRepository|RepositoryProxy repository()
 * @method static Publisher[]|Proxy[]                 all()
 * @method static Publisher[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Publisher[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Publisher[]|Proxy[]                 findBy(array $attributes)
 * @method static Publisher[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Publisher[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class PublisherFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    protected static function getClass(): string
    {
        return Publisher::class;
    }

    /**
     * @return array|mixed[]
     */
    protected function getDefaults(): array
    {
        return [
            'created_at' => self::faker()->dateTime(),
            'name' => self::faker()->text(10),
            'updated_at' => self::faker()->dateTime(),
        ];
    }

    /**
     * @return $this
     */
    protected function initialize(): self
    {
        return $this// ->afterInstantiate(function(Publisher $publisher): void {})
            ;
    }
}
