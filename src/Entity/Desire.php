<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DesireRepository")
 */
class Desire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PurchaseList", inversedBy="desires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $purchase;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $step;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductList", mappedBy="desire", orphanRemoval=true)
     */
    private $productLists;

    public function __construct()
    {
        $this->productLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPurchase(): ?PurchaseList
    {
        return $this->purchase;
    }

    public function setPurchase(?PurchaseList $purchase): self
    {
        $this->purchase = $purchase;

        return $this;
    }

    public function getStep(): ?int
    {
        return $this->step;
    }

    public function setStep(?int $step): self
    {
        $this->step = $step;

        return $this;
    }

    /**
     * @return Collection|ProductList[]
     */
    public function getProductLists(): Collection
    {
        return $this->productLists;
    }

    public function addProductList(ProductList $productList): self
    {
        if (!$this->productLists->contains($productList)) {
            $this->productLists[] = $productList;
            $productList->setDesire($this);
        }

        return $this;
    }

    public function removeProductList(ProductList $productList): self
    {
        if ($this->productLists->contains($productList)) {
            $this->productLists->removeElement($productList);
            // set the owning side to null (unless already changed)
            if ($productList->getDesire() === $this) {
                $productList->setDesire(null);
            }
        }

        return $this;
    }
}
