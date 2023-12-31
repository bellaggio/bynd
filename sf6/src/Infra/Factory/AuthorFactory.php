<?php

namespace App\Infra\Factory;

use App\Infra\Entity\Author;
use App\Infra\Repository\AuthorRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Author>
 *
 * @method        Author|Proxy                     create(array|callable $attributes = [])
 * @method static Author|Proxy                     createOne(array $attributes = [])
 * @method static Author|Proxy                     find(object|array|mixed $criteria)
 * @method static Author|Proxy                     findOrCreate(array $attributes)
 * @method static Author|Proxy                     first(string $sortedField = 'id')
 * @method static Author|Proxy                     last(string $sortedField = 'id')
 * @method static Author|Proxy                     random(array $attributes = [])
 * @method static Author|Proxy                     randomOrCreate(array $attributes = [])
 * @method static AuthorRepository|RepositoryProxy repository()
 * @method static Author[]|Proxy[]                 all()
 * @method static Author[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Author[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Author[]|Proxy[]                 findBy(array $attributes)
 * @method static Author[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Author[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class AuthorFactory extends ModelFactory
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
        return Author::class;
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
        return $this;
    }
}
