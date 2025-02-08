<?php
require_once '../controller/products/catalogsController.php';

// Obtener los datos del formulario
$price = $_POST['price'] ?? '';

// Validar que el nombre de la categoría no esté vacío
if (empty($price)) {
    echo json_encode([
        'success' => false,
        'message' => 'El nombre de la categoría es requerido.'
    ]);
    exit;
}

// Llamar al controlador para agregar la categoría
$controller = new CategoryController();
$result = $controller->addCategoryPrice($price);

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($result);
exit;
