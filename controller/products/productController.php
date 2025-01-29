<?php
require_once '../model/products/productModel.php';

class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function addProduct($productData)
    {
        // Validar datos
        if (
            empty($productData['productName']) ||
            empty($productData['productCategory']) ||
            empty($productData['productPrice'])
        ) {
            return [
                'success' => false,
                'message' => 'Todos los campos son requeridos'
            ];
        }

        // Insertar producto
        return $this->productModel->insertProducts(
            $productData['productName'],
            $productData['productCategory'],
            $productData['productPrice'],
            $productData['productDescription'] ?? ''
        );
    }

    public function getProducts()
    {
        return $this->productModel->getProducts();
    }
}
