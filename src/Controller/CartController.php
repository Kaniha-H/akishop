<?php

namespace App\Controller;

use App\Cart\CartService;
use App\Form\CartConfirmationType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    protected $productRepository;
    protected $cartService;

    public function __construct(CartService $cartService, ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
        $this->cartService = $cartService;
    }

    #[Route('/cart', name: 'cart_show')]
    public function show() 
    {
        $form = $this->createForm(CartConfirmationType::class);

        $detailedCart = $this->cartService->getDetailedCartItems();

        $total = $this->cartService->getTotal();

        return $this->render('cart/index.html.twig', [
            'items' => $detailedCart,
            'total' => $total,
            'confirmationForm' => $form->createView(),
        ]);
    }

    #[Route('/cart/add/{id<\d+>}', name: 'app_cart_add')]
    public function add($id, Request $request)
    {
        $product = $this->productRepository->find($id);

        if(!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas");
        }
        
        $this->cartService->add($id);
        
        if($request->query->get('returnToCart')) {
            return $this->redirectToRoute('cart_show');
        }

        $this->addFlash('success', "Le produit a bien été ajouté au panier");

        return $this->redirectToRoute('product_show', [
            'category_slug' => $product->getSubCategory()->getSlug(),
            'slug' => $product->getSlug()
        ]);
    }

    #[Route('/cart/delete/{id<\d+>}', name: 'cart_delete')]
    public function delete($id) {
        $product = $this->productRepository->find($id);

        if(!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas et ne peut pas être supprimé !");
        }

        $this->cartService->remove($id);

        $this->addFlash('success', "Le produit a bien été supprimé du panier");

        return $this->redirectToRoute('cart_show');
    }

    #[Route('/cart/decrement/{id<\d+>}', name: 'cart_decrement')]
    public function decrement($id) {
        $product = $this->productRepository->find($id);

        if(!$product) {
            throw $this->createNotFoundException("Le produit $id n'existe pas et ne peut pas être décrémenté !");
        }

        $this->cartService->decrement($id);

        return $this->redirectToRoute('cart_show');
    }
}
