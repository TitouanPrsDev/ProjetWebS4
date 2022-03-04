<?php

namespace App\Controller;

use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductCategoryController extends AbstractController
{
    #[Route('/categories', name: 'category_index')]
    public function index(ProductCategoryRepository $productCategoryRepository): Response
    {
        $categories = $productCategoryRepository -> findBy([], [ 'name' => 'ASC' ]);

        return $this -> render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/categories/{category}', name: 'category_detail')]
    public function detail(string $category, ProductCategoryRepository $productCategoryRepository, ProductRepository $productRepository): Response
    {
        $currentCategory = $productCategoryRepository -> find($category);
        $products = $productRepository -> findBy([ 'category' => $category ]);

        return $this -> render('category/detail.html.twig', [
            'category' => $currentCategory,
            'products' => $products
        ]);
    }
}
