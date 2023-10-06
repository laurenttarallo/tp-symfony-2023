<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'app_products')]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
          'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/product/{id}', name: 'app_product')]
    public function one(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
          'product' => $product,
        ]);
    }
}
