<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
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
     * @ORM\OneToMany(targetEntity=Book::class, mappedBy="author_id")
     */
    private $authorsBooks;

    public function __construct() {
        $this->authorsBooks = new ArrayCollection();
    }

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

    /**
     * @return Collection|Book[]
     */
    public function getAuthorsBooks(): Collection {
        return $this->authorsBooks;
    }

    public function addAuthorsBook(Book $authorsBook): self {
        if (!$this->authorsBooks->contains($authorsBook)) {
            $this->authorsBooks[] = $authorsBook;
            $authorsBook->setAuthorId($this);
        }
        return $this;
    }

    public function removeAuthorsBook(Book $authorsBook): self {
        if ($this->authorsBooks->removeElement($authorsBook)) {
            // set the owning side to null (unless already changed)
            if ($authorsBook->getAuthorId() === $this) {
                $authorsBook->setAuthorId(null);
            }
        }
        return $this;
    }
}
