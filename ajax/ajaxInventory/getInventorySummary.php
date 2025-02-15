<?php
require_once __DIR__ . '/../../controller/inventory/inventoryController.php';

$controller = new InventoryController();
$result = $controller->getInventorySummary();

header('Content-Type: application/json');
echo json_encode($result);
exit;
