<?php

namespace App\Infra\Repository;

use App\Core\Adapters\PublisherRepositoryInterface;
use App\Infra\Entity\Publisher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Publisher>
 *
 * @method Publisher|null find($id, $lockMode = null, $lockVersion = null)
 * @method Publisher|null findOneBy(array $criteria, array $orderBy = null)
 * @method Publisher[]    findAll()
 * @method Publisher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublisherRepository extends ServiceEntityRepository implements PublisherRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Publisher::class);
    }

    /**
     * @param string $name
     * @return Publisher|null
     */
    public function findByName(string $name): ?Publisher
    {
        $publisher = $this->findOneBy(['name' => $name]);

        if (!$publisher) {
            return null;
        }

        return $publisher;
    }
}
