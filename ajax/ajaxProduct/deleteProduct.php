<?php
require_once __DIR__ . '/../../controller/products/productController.php';

$productId = $_GET['id'] ?? null;

if (!$productId) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'ID de producto no proporcionado']);
    exit;
}

$productController = new ProductController();
$result = $productController->deleteProduct($productId);

header('Content-Type: application/json');
echo json_encode($result);
exit;
