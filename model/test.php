<?php
require_once 'dbo.php';

$conn = Database::getConnection();

if ($conn) {
    echo "¡Conexión exitosa!";
} else {
    echo "Conexión fallida.";
}
