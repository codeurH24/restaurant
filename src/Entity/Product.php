<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Cat", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductType", mappedBy="product")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductList", mappedBy="product")
     */
    private $productLists;

    public function __construct()
    {
        $this->type = new ArrayCollection();
        $this->productLists = new ArrayCollection();
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

    public function getCat(): ?Cat
    {
        return $this->cat;
    }

    public function setCat(?Cat $cat): self
    {
        $this->cat = $cat;

        return $this;
    }

    /**
     * @return Collection|ProductType[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(ProductType $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
            $type->setProduct($this);
        }

        return $this;
    }

    public function removeType(ProductType $type): self
    {
        if ($this->type->contains($type)) {
            $this->type->removeElement($type);
            // set the owning side to null (unless already changed)
            if ($type->getProduct() === $this) {
                $type->setProduct(null);
            }
        }

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
            $productList->setProduct($this);
        }

        return $this;
    }

    public function removeProductList(ProductList $productList): self
    {
        if ($this->productLists->contains($productList)) {
            $this->productLists->removeElement($productList);
            // set the owning side to null (unless already changed)
            if ($productList->getProduct() === $this) {
                $productList->setProduct(null);
            }
        }

        return $this;
    }
}
