<?php 

namespace App\Cart;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;


class CartService
{
    protected $session;
    protected $productRepository;

    public function __construct(protected RequestStack $requestStack, ProductRepository $productRepository)
    {
        $this->session = $requestStack;
        $this->productRepository = $productRepository;
    }

    protected function getCart(): array {
        return $this->session->getSession()->get('cart', []);
    }

    protected function saveCart(array $cart) {
        return $this->session->getSession()->set('cart', $cart);
    }

    public function empty() {
        $this->saveCart([]);
    }
    
    public function add(int $id) 
    {
        // find cart in the session
        // if it doesnt exist then create empty array
        $cart = $this->getCart();

        // show if product exists in the array
        // if it is, increase the quantity
        // else, add the product with quantity of 1
        if(!array_key_exists($id, $cart)) {
            $cart[$id] = 0;
        }
        
        $cart[$id]++;
        
        // save array updated
        $this->saveCart($cart);  
        
        // $session->remove('cart');
    }

    public function getTotal(): int {
        $total = 0;

        foreach ($this->getCart() as $id => $qty) {
            $product = $this->productRepository->find($id);

            if(!$product) {
                continue;
            }

            $total += $product->getPrice() * $qty;
        }

        return $total;
    }

    public function remove(int $id) {
        $cart = $this->getCart();

        unset($cart[$id]);

        $this->saveCart($cart);
    }

    public function decrement(int $id) {
        $cart = $this->getCart();

        if(!array_key_exists($id, $cart)) {
            return;
        }

        if($cart[$id] === 1) {
            $this->remove($id);
            return;
        }

        $cart[$id]--;

        $this->saveCart($cart);
    }

    /**
     *
     * @return CartItem[]
     */
    public function getDetailedCartItems(): array 
    {
        $detailedCart = [];

        foreach ($this->getCart() as $id => $qty) {
            $product = $this->productRepository->find($id);

            if(!$product) {
                continue;
            }

            $detailedCart[] = new CartItem($product, $qty);
        }

        return $detailedCart;
    }
}