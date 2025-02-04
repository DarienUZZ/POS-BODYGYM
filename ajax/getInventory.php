<?php

require_once '../controller/inventory/inventoryController.php';

$inventory = new InventoryController();
$inventoryData = $inventory->getInventory();

header('Content-Type: application/json');
echo json_encode($inventoryData);
exit;