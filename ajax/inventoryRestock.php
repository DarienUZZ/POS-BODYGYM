<?php
require_once '../controller/inventory/inventoryController.php';


$data = $_POST;

$controller = new InventoryController();
$result = $controller->InventoryRestock($data);

header('Content-Type: application/json');
echo json_encode($result);
exit;