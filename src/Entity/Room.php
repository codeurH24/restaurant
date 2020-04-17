<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Cat", inversedBy="rooms")
     */
    private $cat;

    public function __construct()
    {
        $this->cat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Cat[]
     */
    public function getCat(): Collection
    {
        return $this->cat;
    }

    public function addCat(Cat $cat): self
    {
        if (!$this->cat->contains($cat)) {
            $this->cat[] = $cat;
        }

        return $this;
    }

    public function removeCat(Cat $cat): self
    {
        if ($this->cat->contains($cat)) {
            $this->cat->removeElement($cat);
        }

        return $this;
    }
}
