<?php

namespace App\Controller;

use App\Repository\ProductBrandRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductBrandController extends AbstractController
{
    #[Route('/brands', name: 'brand_index')]
    public function index(ProductBrandRepository $productBrandRepository): Response
    {
        $brands = $productBrandRepository -> findBy([], [ 'name' => 'ASC' ]);
        return $this -> render('brand/index.html.twig', [
            'brands' => $brands
        ]);
    }

    #[Route('/brands/{brand}', name: 'brand_detail')]
    public function detail(string $brand, ProductBrandRepository $productBrandRepository, ProductRepository $productRepository): Response
    {
        $currentBrand = $productBrandRepository -> find($brand);
        $products = $productRepository -> findBy([ 'brand' => $brand ]);

        return $this -> render('brand/detail.html.twig', [
            'brand' => $currentBrand,
            'products' => $products
        ]);
    }
}
