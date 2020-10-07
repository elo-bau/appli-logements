<?php

namespace App\Entity;

use App\Repository\LogementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LogementRepository::class)
 */
class Logement
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
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity=BeneficiaryLogement::class, mappedBy="logement")
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

    public function setId(int $id): self{
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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
            $beneficiaryLogement->addLogement($this);
        }

        return $this;
    }

    public function removeBeneficiaryLogement(BeneficiaryLogement $beneficiaryLogement): self
    {
        if ($this->beneficiaryLogements->contains($beneficiaryLogement)) {
            $this->beneficiaryLogements->removeElement($beneficiaryLogement);
            $beneficiaryLogement->removeLogement($this);
        }

        return $this;
    }
}
