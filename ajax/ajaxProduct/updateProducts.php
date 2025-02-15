<?php
require_once __DIR__ . '/../../controller/products/productController.php';

$productData = [
    'productId' => $_POST['productId'] ?? null,
    'productName' => $_POST['productName'] ?? null,
    'productCategory' => $_POST['productCategory'] ?? null,
    'productPrice' => $_POST['productPrice'] ?? null,
    'productDescription' => $_POST['productDescription'] ?? null,
    'productStatus' => $_POST['productStatus'] ?? null
];

$productController = new ProductController();
$result = $productController->updateProducts($productData);

header('Content-Type: application/json');
echo json_encode($result);
exit;