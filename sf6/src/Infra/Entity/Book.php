<?php

namespace App\Infra\Entity;

use App\Infra\Repository\BookRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: Publisher::class, inversedBy: "publisher")]
    #[ORM\JoinColumn(name: "publisher_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private Publisher $publisher;

    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: "author")]
    #[ORM\JoinColumn(name: "author_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private Author $author;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $ISBN = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    private DateTime $created_at;
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    private DateTime $updated_at;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Book
     */
    public function setId(int $id): Book
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Book
     */
    public function setName(string $name): Book
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Publisher
     */
    public function getPublisher(): Publisher
    {
        return $this->publisher;
    }

    /**
     * @param Publisher $publisher
     * @return $this
     */
    public function setPublisher(Publisher $publisher): Book
    {
        $this->publisher = $publisher;
        return $this;
    }

    /**
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }

    /**
     * @param Author $author
     * @return $this
     */
    public function setAuthor(Author $author): Book
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Book
     */
    public function setDescription(?string $description): Book
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getISBN(): ?int
    {
        return $this->ISBN;
    }

    /**
     * @param int|null $ISBN
     * @return Book
     */
    public function setISBN(?int $ISBN): Book
    {
        $this->ISBN = $ISBN;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    /**
     * @param DateTime $created_at
     * @return Book
     */
    public function setCreatedAt(DateTime $created_at): Book
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param DateTime $updated_at
     * @return Book
     */
    public function setUpdatedAt(DateTime $updated_at): Book
    {
        $this->updated_at = $updated_at;
        return $this;
    }
}
