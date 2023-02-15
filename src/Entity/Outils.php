<?php

namespace App\Entity;

use App\Repository\OutilsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OutilsRepository::class)]
class Outils
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label_out = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'outil')]
    private ?Reservation $reservations = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabelOut(): ?string
    {
        return $this->label_out;
    }

    public function setLabelOut(string $label_out): self
    {
        $this->label_out = $label_out;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getReservations(): ?Reservation
    {
        return $this->reservations;
    }

    public function setReservations(?Reservation $reservations): self
    {
        $this->reservations = $reservations;

        return $this;
    }
}
