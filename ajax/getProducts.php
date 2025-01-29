<?php

require_once '../controller/products/productController.php';

$products = new ProductController();
$productData = $products->getProducts();

header('Content-Type: application/json');
echo json_encode($productData);
exit;