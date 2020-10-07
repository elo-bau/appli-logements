<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
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
    private $label;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="user_group")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=role::class, inversedBy="groups")
     */
    private $role_group;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->role_group = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addUserGroup($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeUserGroup($this);
        }

        return $this;
    }

    /**
     * @return Collection|role[]
     */
    public function getRoleGroup(): Collection
    {
        return $this->role_group;
    }

    public function addRoleGroup(role $roleGroup): self
    {
        if (!$this->role_group->contains($roleGroup)) {
            $this->role_group[] = $roleGroup;
        }

        return $this;
    }

    public function removeRoleGroup(role $roleGroup): self
    {
        if ($this->role_group->contains($roleGroup)) {
            $this->role_group->removeElement($roleGroup);
        }

        return $this;
    }
}
