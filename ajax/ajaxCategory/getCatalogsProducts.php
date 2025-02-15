<?php

require_once __DIR__ . '/../../controller/products/catalogsController.php';

$categoryController = new CategoryController();
$categories = $categoryController->getCategories();

header('Content-Type: application/json');
echo json_encode($categories);
exit;
