<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=35)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfPublish;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="authors_books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getDateOfPublish(): ?\DateTimeInterface {
        return $this->dateOfPublish;
    }

    public function setDateOfPublish(\DateTimeInterface $dateOfPublish): self {
        $this->dateOfPublish = $dateOfPublish;

        return $this;
    }

    public function getAuthorId(): ?Author {
        return $this->author;
    }

    public function setAuthorId(?Author $author): self {
        $this->author = $author;
        return $this;
    }
}
