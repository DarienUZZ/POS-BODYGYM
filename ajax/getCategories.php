<?php

require_once '../controller/products/categoryController.php';

$categoryController = new CategoryController();
$categories = $categoryController->getCategories();

header('Content-Type: application/json');
echo json_encode($categories);
exit;
