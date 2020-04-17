<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PurchaseListRepository")
 */
class PurchaseList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Desire", mappedBy="purchase", orphanRemoval=true)
     */
    private $desires;

    public function __construct()
    {
        $this->desires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Desire[]
     */
    public function getDesires(): Collection
    {
        return $this->desires;
    }

    public function addDesire(Desire $desire): self
    {
        if (!$this->desires->contains($desire)) {
            $this->desires[] = $desire;
            $desire->setPurchase($this);
        }

        return $this;
    }

    public function removeDesire(Desire $desire): self
    {
        if ($this->desires->contains($desire)) {
            $this->desires->removeElement($desire);
            // set the owning side to null (unless already changed)
            if ($desire->getPurchase() === $this) {
                $desire->setPurchase(null);
            }
        }

        return $this;
    }
}
