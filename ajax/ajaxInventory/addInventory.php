<?php
require_once __DIR__ . '/../../controller/inventory/inventoryController.php';

$productId = $_POST['productId'];
$quantity = $_POST['quantity'];
$date = $_POST['date'];
$time = $_POST['time'];

// Crear un array con los datos
$inventoryData = [
    'productId' => $productId,
    'quantity' => $quantity,
    'date' => $date,
    'time' => $time
];

$inventoryController = new InventoryController();
$result = $inventoryController->insertInventory($inventoryData);

header('Content-Type: application/json');
echo json_encode($result);
exit;
