<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type_doc = null;

    #[ORM\ManyToOne(inversedBy: 'Documents')]
    private ?User $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeDoc(): ?string
    {
        return $this->type_doc;
    }

    public function setTypeDoc(string $type_doc): self
    {
        $this->type_doc = $type_doc;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }
}
