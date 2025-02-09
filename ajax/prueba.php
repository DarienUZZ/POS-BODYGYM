<?php
header('Content-Type: application/json');

// Simulación de datos (deberías obtenerlos desde tu base de datos)
$response = [
    "card" => [200, 400, 300, 500, 700, 800, 600], // Pagos con tarjeta
    "sinpe" => [150, 350, 200, 400, 650, 700, 500], // Pagos con Sinpe
    "cash" => [100, 250, 150, 300, 500, 600, 400] ,// Pagos en efectivo,
    "topProducts" => [
        "labels" => ["Proteína", "Creatina", "Aminoácidos", "Glutamina", "Pre-entreno"],
        "values" => [50, 40, 30, 20, 10]
    ]
];

echo json_encode($response);
