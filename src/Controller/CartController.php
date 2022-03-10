<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    #[Route('/cart', name: 'cart')]
    public function index(productRepository $productRepository, SessionInterface $session): Response
    {

        $cart = $session->get("cart", []);
        $session->get('cart');
        $dataCart = [];
        $total = 0;

        foreach ($cart as $id => $quantity) {
            $product = $productRepository->find($id);
            $dataCart[] = [
                "product" => $product,
                "quantity" => $quantity
            ];
            $total += $product->getPrice() * $quantity;
        }

        return $this->render('cart/index.html.twig', compact("dataCart", "total"));
    }


    #[Route('/addcart/{id}', name: 'add-cart')]
    public function add(Request $request, Product $product, int $id, SessionInterface $session): Response
    {


        $products = $product->getId($id);
        $cart = $session->get("cart", []);

        if (!empty($cart[$products])) {
            $cart[$products]++;
        } else {
            $cart[$products] = 1;
        }

        $session->set("cart", $cart);

        $previous = $request->headers->get("referer");
        return $this->redirect($previous);
    }

    #[Route('/removecart/{id}', name: 'remove-cart')]
    public function remove(Request $request, Product $product, int $id, SessionInterface $session): Response
    {


        $products = $product->getId($id);
        $cart = $session->get("cart", []);

        if ((!empty($cart[$products])) && ($cart[$products] > 1)) {

            $cart[$products]--;
        }

        $session->set("cart", $cart);

        $previous = $request->headers->get("referer");
        return $this->redirect($previous);
    }

    #[Route('/deletecart/{id}', name: 'delete-cart')]
    public function delete(Request $request, Product $product, int $id, SessionInterface $session): Response
    {


        $products = $product->getId($id);
        $cart = $session->get("cart", []);

        if (!empty($cart[$products])) {

            unset($cart[$products]);
        }

        $session->set("cart", $cart);

        $previous = $request->headers->get("referer");
        return $this->redirect($previous);
    }
}
