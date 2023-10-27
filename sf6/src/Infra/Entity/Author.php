<?php

namespace App\Infra\Entity;

use App\Infra\Repository\AuthorRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\OneToMany(mappedBy: "author", targetEntity: Book::class, cascade: ["persist", "remove"])]
    private $books;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private string $name;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): Author
    {
        $this->name = $name;
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
     * @return Author
     */
    public function setCreatedAt(DateTime $created_at): Author
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
     * @return Author
     */
    public function setUpdatedAt(DateTime $updated_at): Author
    {
        $this->updated_at = $updated_at;
        return $this;
    }
}
