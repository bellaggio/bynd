<?php

namespace App\Infra\Repository;

use App\Core\Adapters\BookRepositoryInterface;
use App\Infra\Entity\Author;
use App\Infra\Entity\Book;
use App\Infra\Entity\Publisher;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository implements BookRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @param int $id
     * @param array $data
     * @param Author $hasAuthor
     * @param Publisher $hasPublisher
     * @return Book
     * @throws Exception
     */
    public function update(int $id, array $data, Author $hasAuthor, Publisher $hasPublisher): Book
    {
        $entityManager = $this->getEntityManager();
        $book = $this->find($id);

        if (!$book) {
            throw new Exception('No book found for id ' . $id);
        }

        $book->setName($data['name']);
        $book->setAuthor($hasAuthor);
        $book->setPublisher($hasPublisher);
        $book->setISBN($data['ISBN']);
        $book->setUpdatedAt(new DateTime('now'));
        $entityManager->persist($book);
        $entityManager->flush();

        return $book;
    }

    /**
     * @param array $data
     * @param Author $hasAuthor
     * @param Publisher $hasPublisher
     * @return Book
     */
    public function create(array $data, Author $hasAuthor, Publisher $hasPublisher): Book
    {
        $entityManager = $this->getEntityManager();

        $book = new Book();
        $book->setName($data['name']);
        $book->setAuthor($hasAuthor);
        $book->setPublisher($hasPublisher);
        $book->setISBN($data['ISBN']);
        $book->setUpdatedAt(new DateTime('now'));
        $book->setCreatedAt(new DateTime('now'));
        $entityManager->persist($book);

        $entityManager->flush();

        return $book;
    }

    /**
     * @param string $name
     * @return Book|null
     */
    public function search(string $name): ?Book
    {
        $book = $this->findOneBy(['name' => $name]);

        if (!$book) {
            return null;
        }

        return $book;
    }
}
