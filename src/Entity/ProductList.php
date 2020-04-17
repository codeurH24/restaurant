<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductListRepository")
 */
class ProductList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Desire", inversedBy="productLists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $desire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="productLists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesire(): ?Desire
    {
        return $this->desire;
    }

    public function setDesire(?Desire $desire): self
    {
        $this->desire = $desire;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
