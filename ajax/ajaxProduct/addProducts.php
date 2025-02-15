<?php

require_once __DIR__ . '/../../controller/products/productController.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST')
{
    header('HTTP/1.1 405 Method Not Allowed');
    exit;
}

$productData = $_POST;

$productController = new ProductController();
$response = $productController->addProduct($productData);

header('Content-Type: application/json');
echo json_encode($response);
exit;