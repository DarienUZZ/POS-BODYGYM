<?php
require_once '../controller/inventory/inventoryController.php';

$controller = new InventoryController();
$result = $controller->getInventorySummary();

header('Content-Type: application/json');
echo json_encode($result);
exit;
