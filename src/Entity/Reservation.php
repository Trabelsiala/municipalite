<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_res = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_lim = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $users = null;

    #[ORM\OneToMany(mappedBy: 'reservations', targetEntity: Outils::class)]
    private Collection $outil;

    public function __construct()
    {
        $this->outil = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRes(): ?\DateTimeInterface
    {
        return $this->date_res;
    }

    public function setDateRes(\DateTimeInterface $date_res): self
    {
        $this->date_res = $date_res;

        return $this;
    }

    public function getDateLim(): ?\DateTimeInterface
    {
        return $this->date_lim;
    }

    public function setDateLim(\DateTimeInterface $date_lim): self
    {
        $this->date_lim = $date_lim;

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

    /**
     * @return Collection<int, Outils>
     */
    public function getOutil(): Collection
    {
        return $this->outil;
    }

    public function addOutil(Outils $outil): self
    {
        if (!$this->outil->contains($outil)) {
            $this->outil->add($outil);
            $outil->setReservations($this);
        }

        return $this;
    }

    public function removeOutil(Outils $outil): self
    {
        if ($this->outil->removeElement($outil)) {
            // set the owning side to null (unless already changed)
            if ($outil->getReservations() === $this) {
                $outil->setReservations(null);
            }
        }

        return $this;
    }
}
