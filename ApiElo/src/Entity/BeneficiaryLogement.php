<?php

namespace App\Entity;

use App\Repository\BeneficiaryLogementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BeneficiaryLogementRepository::class)
 */
class BeneficiaryLogement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Beneficiary::class, inversedBy="beneficiaryLogements")
     */
    private $beneficiary;

    /**
     * @ORM\ManyToMany(targetEntity=Logement::class, inversedBy="beneficiaryLogements")
     */
    private $logement;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endAt;

    public function __construct()
    {
        $this->beneficiary = new ArrayCollection();
        $this->logement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|beneficiary[]
     */
    public function getBeneficiary(): Collection
    {
        return $this->beneficiary;
    }

    public function addBeneficiary(beneficiary $beneficiary): self
    {
        if (!$this->beneficiary->contains($beneficiary)) {
            $this->beneficiary[] = $beneficiary;
        }

        return $this;
    }

    public function removeBeneficiary(beneficiary $beneficiary): self
    {
        if ($this->beneficiary->contains($beneficiary)) {
            $this->beneficiary->removeElement($beneficiary);
        }

        return $this;
    }

    /**
     * @return Collection|logement[]
     */
    public function getLogement(): Collection
    {
        return $this->logement;
    }

    public function addLogement(logement $logement): self
    {
        if (!$this->logement->contains($logement)) {
            $this->logement[] = $logement;
        }

        return $this;
    }

    public function removeLogement(logement $logement): self
    {
        if ($this->logement->contains($logement)) {
            $this->logement->removeElement($logement);
        }

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }
}
