<?php

namespace App\Infra\Entity;

use App\Infra\Repository\PublisherRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublisherRepository::class)]
class Publisher
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private string $name;

    #[ORM\OneToMany(mappedBy: "publisher", targetEntity: Book::class, cascade: ["persist", "remove"])]
    private $books;
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
     * @return Publisher
     */
    public function setName(string $name): Publisher
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
     * @return Publisher
     */
    public function setCreatedAt(DateTime $created_at): Publisher
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
     * @return Publisher
     */
    public function setUpdatedAt(DateTime $updated_at): Publisher
    {
        $this->updated_at = $updated_at;
        return $this;
    }
}
