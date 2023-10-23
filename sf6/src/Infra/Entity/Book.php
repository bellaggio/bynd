<?php

namespace App\Infra\Entity;

use App\Infra\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id ;

    #[ORM\Column(length: 255)]
    private string $name ;

    #[ORM\OneToOne(inversedBy: "books", targetEntity: Publisher::class)]
    #[ORM\JoinColumn(nullable: false,onDelete: "CASCADE")]
    private ArrayCollection $publisher;

    #[ORM\OneToOne(inversedBy: "books", targetEntity: Author::class)]
    #[ORM\JoinColumn(nullable: false,onDelete: "CASCADE")]
    private ArrayCollection $author;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $ISBN = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,nullable: false)]
    private \DateTime $created_at;
    #[ORM\Column(type: Types::DATETIME_MUTABLE,nullable: false)]
    private \DateTime $updated_at;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param mixed $publisher
     * @return Book
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     * @return Book
     */
    public function setCreatedAt(\DateTime $created_at): Book
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTime $updated_at
     * @return Book
     */
    public function setUpdatedAt(\DateTime $updated_at): Book
    {
        $this->updated_at = $updated_at;
        return $this;
    }
}
