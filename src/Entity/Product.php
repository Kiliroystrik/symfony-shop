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

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: true)]
    private $category;

    #[ORM\OneToMany(mappedBy: 'idProduct', targetEntity: ProductLine::class)]
    private $productLines;

    public function __construct()
    {
        $this->productLines = new ArrayCollection();
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


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price / 100;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, ProductLine>
     */
    public function getProductLines(): Collection
    {
        return $this->productLines;
    }

    public function addProductLine(ProductLine $productLine): self
    {
        if (!$this->productLines->contains($productLine)) {
            $this->productLines[] = $productLine;
            $productLine->setIdProduct($this);
        }

        return $this;
    }

    public function removeProductLine(ProductLine $productLine): self
    {
        if ($this->productLines->removeElement($productLine)) {
            // set the owning side to null (unless already changed)
            if ($productLine->getIdProduct() === $this) {
                $productLine->setIdProduct(null);
            }
        }

        return $this;
    }
}
