<?php

namespace App\Entity;

use App\Repository\BeneficiaryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BeneficiaryRepository::class)
 */
class Beneficiary
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $ssin;

    /**
     * @ORM\ManyToMany(targetEntity=BeneficiaryLogement::class, mappedBy="beneficiary")
     */
    private $beneficiaryLogements;

    public function __construct()
    {
        $this->beneficiaryLogements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $name): self
    {
        $this->first_name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getSsin(): ?int
    {
        return $this->ssin;
    }

    public function setSsin(int $ssin): self
    {
        $this->ssin = $ssin;

        return $this;
    }

    /**
     * @return Collection|BeneficiaryLogement[]
     */
    public function getBeneficiaryLogements(): Collection
    {
        return $this->beneficiaryLogements;
    }

    public function addBeneficiaryLogement(BeneficiaryLogement $beneficiaryLogement): self
    {
        if (!$this->beneficiaryLogements->contains($beneficiaryLogement)) {
            $this->beneficiaryLogements[] = $beneficiaryLogement;
            $beneficiaryLogement->addBeneficiary($this);
        }

        return $this;
    }

    public function removeBeneficiaryLogement(BeneficiaryLogement $beneficiaryLogement): self
    {
        if ($this->beneficiaryLogements->contains($beneficiaryLogement)) {
            $this->beneficiaryLogements->removeElement($beneficiaryLogement);
            $beneficiaryLogement->removeBeneficiary($this);
        }

        return $this;
    }
}
