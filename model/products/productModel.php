<?php

require_once '../model/dbo.php';

class ProductModel
{
    public function insertProducts($productName, $categoryId, $priceId, $description)
    {
        try {
            $db = new database();
            $conn = $db->getConnection();

            $query = "INSERT INTO productos (nombre_producto, catalago_productos, catalago_precio, descripcion, activo) 
        VALUES (:productName, :categoryId, :priceId, :description, 1)";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(':productName', $productName);
            $stmt->bindParam(':categoryId', $categoryId);
            $stmt->bindParam(':priceId', $priceId);
            $stmt->bindParam(':description', $description);

            $stmt->execute();

            return [
                'success' => true,
                'message' => 'Product was successfully',
                'id' => $conn->lastInsertId()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    public function getProducts()
    {
        try {
            $db = new database();
            $conn = $db->getConnection();

            $query = "
            SELECT 
                p.id_producto, 
                p.nombre_producto, 
                p.descripcion,
                cp.descripcion AS categoria,
                cpp.precio,
                p.activo
            FROM productos p
            JOIN catalago_productos cp ON p.catalago_productos = cp.id_catalago_productos
            JOIN catalago_precio cpp ON p.catalago_precio = cpp.id_catalago_precio
            ORDER BY p.id_producto DESC
        ";

            $stmt = $conn->prepare($query);
            $stmt->execute(); // Añadimos esta línea
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
}
