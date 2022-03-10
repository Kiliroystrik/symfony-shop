<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 10)]
    private $tel;

    #[ORM\Column(type: 'string', length: 255)]
    private $customerName;

    #[ORM\Column(type: 'float')]
    private $total;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'boolean')]
    private $inProgress;

    #[ORM\Column(type: 'datetime')]
    private $deliveryTime;

    #[ORM\OneToMany(mappedBy: 'commandNumber', targetEntity: ProductLine::class)]
    private $productLines;

    public function __construct()
    {
        $this->productLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function setCustomerName(string $customerName): self
    {
        $this->customerName = $customerName;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getInProgress(): ?bool
    {
        return $this->inProgress;
    }

    public function setInProgress(bool $inProgress): self
    {
        $this->inProgress = $inProgress;

        return $this;
    }

    public function getDeliveryTime(): ?\DateTimeInterface
    {
        return $this->deliveryTime;
    }

    public function setDeliveryTime(\DateTimeInterface $deliveryTime): self
    {
        $this->deliveryTime = $deliveryTime;

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
            $productLine->setCommandNumber($this);
        }

        return $this;
    }

    public function removeProductLine(ProductLine $productLine): self
    {
        if ($this->productLines->removeElement($productLine)) {
            // set the owning side to null (unless already changed)
            if ($productLine->getCommandNumber() === $this) {
                $productLine->setCommandNumber(null);
            }
        }

        return $this;
    }
}
