<?php

require_once __DIR__ . '/../../controller/inventory/inventoryController.php';

$inventory = new InventoryController();
$inventoryData = $inventory->getInventory();

header('Content-Type: application/json');
echo json_encode($inventoryData);
exit;