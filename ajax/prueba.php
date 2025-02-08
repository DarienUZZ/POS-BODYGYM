<?php
header('Content-Type: application/json');

// Simulación de datos (deberías obtenerlos desde tu base de datos)
$response = [
    "sales" => [
        "labels" => ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"],
        "values" => [100, 150, 200, 250, 300]
    ],
    "topProducts" => [
        "labels" => ["Proteína", "Creatina", "Aminoácidos", "Glutamina", "Pre-entreno"],
        "values" => [50, 40, 30, 20, 10]
    ]
];

echo json_encode($response);
