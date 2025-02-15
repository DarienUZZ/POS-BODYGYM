<?php
require_once __DIR__ . '/../../model/products/productModel.php';

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

    public function updateProducts($productData)
    {
        if (empty($productData['productId'])) {
            return [
                'success' => false,
                'message' => 'El ID del producto es requerido'
            ];
        }

        $updateResult = $this->productModel->updateProduct(
            $productData['productId'],
            $productData['productName'],
            $productData['productCategory'],
            $productData['productPrice'],
            $productData['productDescription']?? '',
            $productData['productStatus']?? 1
        );

        if($updateResult['success']) {
            return [
                'success' => true,
                'message' => 'Producto actualizado correctamente'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'No se pudo actualizar el producto'
            ];
        }

    }

    public function deleteProduct($productId){
        
        return $this->productModel->deleteProduct($productId);
    }

    public function getProductById($productId)
    {
        return $this->productModel->getProductById($productId);
    }

    // controller/products/productController.php


}