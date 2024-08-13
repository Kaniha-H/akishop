<?php 

namespace App\Purchase;

use App\Cart\CartService;
use App\Entity\Purchase;
use App\Entity\PurchaseItem;
use App\Entity\Status;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

use function Symfony\Component\Clock\now;

class PurchasePersister
{
    protected $security;
    protected $cartService;
    protected $em;

    public function __construct(Security $security, CartService $cartService, EntityManagerInterface $em)
    {
        $this->security = $security;
        $this->cartService = $cartService;
        $this->em = $em;
    }

    public function storePurchase(Purchase $purchase, Status $status) 
    {

        $status = new Status;
        $status->setName('PENDING');
        
        $purchase
            ->setUser($this->security->getUser())
            ->setPurchaseAt(now())
            ->setTotal($this->cartService->getTotal())
            ->setStatus($status);

        $this->em->persist($status);
        $this->em->persist($purchase);

        foreach ($this->cartService->getDetailedCartItems() as $cartItem) {
            $purchaseItem = new PurchaseItem;
            $purchaseItem
                ->setPurchase($purchase)
                ->setProduct($cartItem->product)
                ->setProductName($cartItem->product->getName())
                ->setQuantity($cartItem->qty)
                ->setProductPirce($cartItem->product->getPrice())
                ->setTotal($cartItem->getTotal());

            $this->em->persist($purchaseItem);
        }

        $this->em->flush();
    }
}