<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_index')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository -> findAll();
        return $this -> render('product/index.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/products/{product}', name: 'product_detail')]
    public function detail(string $product, ProductRepository $productRepository): Response
    {
        $currentProduct = $productRepository -> find($product);
        return $this -> render('product/detail.html.twig', [
            'product' => $currentProduct
        ]);
    }
}
