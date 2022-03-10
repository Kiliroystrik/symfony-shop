<?php

namespace App\Entity;

use App\Repository\ProductLineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductLineRepository::class)]
class ProductLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $qteProduct;

    #[ORM\Column(type: 'float')]
    private $total;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productLines')]
    #[ORM\JoinColumn(nullable: false)]
    private $idProduct;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'productLines')]
    #[ORM\JoinColumn(nullable: false)]
    private $commandNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteProduct(): ?int
    {
        return $this->qteProduct;
    }

    public function setQteProduct(int $qteProduct): self
    {
        $this->qteProduct = $qteProduct;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getIdProduct(): ?Product
    {
        return $this->idProduct;
    }

    public function setIdProduct(?Product $idProduct): self
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    public function getCommandNumber(): ?Order
    {
        return $this->commandNumber;
    }

    public function setCommandNumber(?Order $commandNumber): self
    {
        $this->commandNumber = $commandNumber;

        return $this;
    }
}
