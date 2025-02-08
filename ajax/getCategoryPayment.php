<?php

require_once '../controller/products/catalogsController.php';

$categoryController = new CategoryController();
$methodPayment = $categoryController->getCategoryMethodPayment();

header('Content-Type: application/json');
echo json_encode($methodPayment);
exit;
