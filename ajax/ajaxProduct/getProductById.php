<?php

require_once __DIR__ . '/../../controller/products/productController.php';

$productoId = $_GET['id'];

$productController = new ProductController();
$result = $productController->getProductById($productoId);

header('Content-Type: application/json');
echo json_encode($result);
exit;
