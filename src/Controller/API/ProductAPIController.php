<?php

namespace App\Controller\API;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductAPIController extends AbstractController
{
    // #[Route('/api/products/{id}', 'api_product_update', [],[],[], null,'PATCH')]
    // public function update(Product $product, Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    // {
        // $requestData = $request->getContent();
        // $updatedProduct = $serializer->deserialize($requestData, Product::class, 'json');

        // $product->setName($updatedProduct->getName());
        // $product->setPrice($updatedProduct->getPrice());

        // $entityManager->flush();

        // return new Response('Product updated!', 200);
    // }
}
