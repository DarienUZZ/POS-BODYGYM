<?php
require_once __DIR__ . '/../../controller/products/catalogsController.php';

// Obtener los datos del formulario
$methodPayment = $_POST['methodPayment'] ?? '';

// Validar que el nombre de la categoría no esté vacío
if (empty($methodPayment)) {
    echo json_encode([
        'success' => false,
        'message' => 'El nombre de la metodo es requerido.'
    ]);
    exit;
}

// Llamar al controlador para agregar la categoría
$controller = new CategoryController();
$result = $controller->addCategoryMethodPayment($methodPayment);

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($result);
exit;
