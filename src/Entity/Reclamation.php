<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_rec = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_rec = null;

    #[ORM\Column(length: 255)]
    private ?string $description_rec = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Avis $aviss = null;

    #[ORM\ManyToOne(inversedBy: 'reclamations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRec(): ?\DateTimeInterface
    {
        return $this->date_rec;
    }

    public function setDateRec(\DateTimeInterface $date_rec): self
    {
        $this->date_rec = $date_rec;

        return $this;
    }

    public function getTitreRec(): ?string
    {
        return $this->titre_rec;
    }

    public function setTitreRec(string $titre_rec): self
    {
        $this->titre_rec = $titre_rec;

        return $this;
    }

    public function getDescriptionRec(): ?string
    {
        return $this->description_rec;
    }

    public function setDescriptionRec(string $description_rec): self
    {
        $this->description_rec = $description_rec;

        return $this;
    }

    public function getAviss(): ?Avis
    {
        return $this->aviss;
    }

    public function setAviss(?Avis $aviss): self
    {
        $this->aviss = $aviss;

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
