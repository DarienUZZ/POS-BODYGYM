<?php

require_once '../controller/products/categoryController.php';

$categoryController = new CategoryController();
$price = $categoryController->getPrice();

header('Content-Type: application/json');
echo json_encode($price);
exit;