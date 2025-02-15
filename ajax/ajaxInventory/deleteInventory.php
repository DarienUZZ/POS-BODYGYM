<?php

require_once __DIR__ . '/../../controller/inventory/inventoryController.php';

$inventoryId = $_GET['id'] ?? null;

if (!$inventoryId) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'ID del inventario no proporcionado']);
    exit;
}

$inventoryController = new InventoryController();
$result = $inventoryController->deleteProduct($inventoryId);

header('Content-Type: application/json');
echo json_encode($result);
exit;
