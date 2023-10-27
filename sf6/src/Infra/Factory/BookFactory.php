<?php

namespace App\Infra\Factory;

use App\Infra\Entity\Book;
use App\Infra\Repository\BookRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

use function Zenstruck\Foundry\lazy;

/**
 * @extends ModelFactory<Book>
 *
 * @method        Book|Proxy                     create(array|callable $attributes = [])
 * @method static Book|Proxy                     createOne(array $attributes = [])
 * @method static Book|Proxy                     find(object|array|mixed $criteria)
 * @method static Book|Proxy                     findOrCreate(array $attributes)
 * @method static Book|Proxy                     first(string $sortedField = 'id')
 * @method static Book|Proxy                     last(string $sortedField = 'id')
 * @method static Book|Proxy                     random(array $attributes = [])
 * @method static Book|Proxy                     randomOrCreate(array $attributes = [])
 * @method static BookRepository|RepositoryProxy repository()
 * @method static Book[]|Proxy[]                 all()
 * @method static Book[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Book[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Book[]|Proxy[]                 findBy(array $attributes)
 * @method static Book[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Book[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class BookFactory extends ModelFactory
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
        return Book::class;
    }

    /**
     * @return array|mixed[]
     */
    protected function getDefaults(): array
    {
        return [
            'created_at' => self::faker()->dateTime(),
            'name' => self::faker()->text(15),
            'publisher' => lazy(fn() => PublisherFactory::randomOrCreate()),
            'author' => lazy(fn() => AuthorFactory::randomOrCreate()),
            'description' => self::faker()->text(255),
            'ISBN' => self::faker()->numberBetween(1, 1000),
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
