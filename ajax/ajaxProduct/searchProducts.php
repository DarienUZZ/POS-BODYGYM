<?php
require_once __DIR__ . '/../../controller/inventory/inventoryController.php';

$products = new InventoryController();
$productData = $products->getProducts();

header('Content-Type: application/json');
echo json_encode($productData['data']);
exit;