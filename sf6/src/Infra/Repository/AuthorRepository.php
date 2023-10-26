<?php

namespace App\Infra\Repository;

use App\Core\Adapters\AuthorRepositoryInterface;
use App\Infra\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 *
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository implements AuthorRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    /**
     * @param string $name
     * @return Author|null
     */
    public function findByName(string $name): ?Author
    {
        $author = $this->findOneBy(['name' => $name]);

        if (!$author) {
            return null;
        }

        return $author;
    }
}
