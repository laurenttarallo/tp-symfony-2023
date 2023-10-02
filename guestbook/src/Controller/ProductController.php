<?php

namespace App\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private array $products = [
        [
          'id' => 1,
          'name' => 'Iphone 13',
          'price' => 999.99,
          'description' => 'Apple iPhone 13 Pro 256 Go Bleu Pacifique',
          'category' => 'smartphone',
        ],
        [
          'id' => 2,
          'name' => 'Samsung Galaxy S21',
          'price' => 899.99,
          'description' => 'Samsung Galaxy S21 5G 128 Go Double SIM Noir Phantom',
          'category' => 'smartphone',
        ],
        [
          'id' => 3,
          'name' => 'Huawei P40',
          'price' => 799.99,
          'description' => 'Huawei P40 Pro 5G 256 Go Double SIM Noir',
          'category' => 'smartphone',
        ],
        [
          'id' => 4,
          'name' => 'MacBook Pro',
          'price' => 1299.99,
          'description' => 'Apple MacBook Pro 13" 256 Go SSD 8 Go RAM Intel Core i5 quadricœur à 1,4 GHz Argent',
          'category' => 'laptop',
        ]
        ];

    
        #[Route('/products', name: 'app_products')]
        public function index(): JsonResponse
        {
            return new JsonResponse($this->products);
        }
    
        #[Route('/product/{id}', name: 'app_product')]
        public function one(int $id): JsonResponse
        {
            $productColection = new ArrayCollection($this->products);

            $product = $productColection->findFirst(fn(int $key, array $product) => $id === $product['id']);

            return new JsonResponse($product);
        }
}
