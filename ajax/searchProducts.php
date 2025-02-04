<?php
require_once '../controller/inventory/inventoryController.php';

$products = new InventoryController();
$productData = $products->getProducts();

header('Content-Type: application/json');
echo json_encode($productData['data']);
exit;