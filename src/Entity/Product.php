<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'integer')]
    private $stock;

    #[ORM\ManyToOne(targetEntity: ProductBrand::class, inversedBy: 'product')]
    #[ORM\JoinColumn(nullable: false)]
    private $brand;

    #[ORM\ManyToOne(targetEntity: ProductCategory::class, inversedBy: 'product')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\ManyToMany(targetEntity: Order::class, inversedBy: 'product')]
    private $orders;

    #[ORM\OneToOne(mappedBy: 'product', targetEntity: ProductCharacteristics::class, cascade: ['persist', 'remove'])]
    private $productCharacteristics;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCharacteristicsId(): ?ProductCharacteristics
    {
        return $this->characteristics;
    }

    public function setCharacteristicsId(ProductCharacteristics $characteristics): self
    {
        $this->characteristics = $characteristics;

        return $this;
    }

    public function getBrand(): ?ProductBrand
    {
        return $this->brand;
    }

    public function setBrand(?ProductBrand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCategory(): ?ProductCategory
    {
        return $this->category;
    }

    public function setCategory(?ProductCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        $this->orders->removeElement($order);

        return $this;
    }

    public function getProductCharacteristics(): ?ProductCharacteristics
    {
        return $this->productCharacteristics;
    }

    public function setProductCharacteristics(ProductCharacteristics $productCharacteristics): self
    {
        // set the owning side of the relation if necessary
        if ($productCharacteristics->getProduct() !== $this) {
            $productCharacteristics->setProduct($this);
        }

        $this->productCharacteristics = $productCharacteristics;

        return $this;
    }
}
