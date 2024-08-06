<?php

namespace App\Entity;

use App\Repository\PurchaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PurchaseRepository::class)]
class Purchase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fullname = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $postalcode = null;

    #[ORM\Column]
    private ?int $total = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $purchaseAt = null;

    /**
     * @var Collection<int, PurchaseItem>
     */
    #[ORM\OneToMany(targetEntity: PurchaseItem::class, mappedBy: 'purchase')]
    private Collection $purchaseitems;

    #[ORM\ManyToOne(inversedBy: 'purchases')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'purchases')]
    private ?Status $status = null;

    public function __construct()
    {
        $this->purchaseitems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): static
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalcode(): ?string
    {
        return $this->postalcode;
    }

    public function setPostalcode(string $postalcode): static
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getPurchaseAt(): ?\DateTimeImmutable
    {
        return $this->purchaseAt;
    }

    public function setPurchaseAt(\DateTimeImmutable $purchaseAt): static
    {
        $this->purchaseAt = $purchaseAt;

        return $this;
    }

    /**
     * @return Collection<int, PurchaseItem>
     */
    public function getPurchaseitems(): Collection
    {
        return $this->purchaseitems;
    }

    public function addPurchaseitem(PurchaseItem $purchaseitem): static
    {
        if (!$this->purchaseitems->contains($purchaseitem)) {
            $this->purchaseitems->add($purchaseitem);
            $purchaseitem->setPurchase($this);
        }

        return $this;
    }

    public function removePurchaseitem(PurchaseItem $purchaseitem): static
    {
        if ($this->purchaseitems->removeElement($purchaseitem)) {
            // set the owning side to null (unless already changed)
            if ($purchaseitem->getPurchase() === $this) {
                $purchaseitem->setPurchase(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): static
    {
        $this->status = $status;

        return $this;
    }
    
    public function __toString()
    {
        return $this->fullname;
    }
    
}
