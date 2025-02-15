<?php

require_once __DIR__ . '/../../model/dbo.php';

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

    public function updateProduct($productId, $productName, $categoryId, $priceId, $description, $status)
    {
        try {
            $db = new database();
            $conn = $db->getConnection();

            $query = "
        UPDATE productos SET 
        nombre_producto = :productName, 
        catalago_productos = :categoryId, 
        catalago_precio = :priceId, 
        descripcion = :description,
        activo = :status
        WHERE id_producto = :productId";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(':productId', $productId);
            $stmt->bindParam(':productName', $productName);
            $stmt->bindParam(':categoryId', $categoryId);
            $stmt->bindParam(':priceId', $priceId);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':status', $status);

            $stmt->execute();

            return [
                'success' => true,
                'message' => 'Product was successfully updated'
            ];
        } catch (Exception $e) {
            // Captura y muestra el error
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    public function deleteProduct($productId)
    {
        try {

            $db = new database();
            $conn = $db->getConnection();

            $query = "
            DELETE FROM productos WHERE id_producto = :productId";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':productId', $productId);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return [
                    'success' => true,
                    'message' => 'Product deleted successfully'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Product not found or already deleted'
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    public function getProductById($producId)
    {
        try {
            $db = new database();
            $conn = $db->getConnection();

            $query = "
            SELECT 
                id_producto, 
                nombre_producto, 
                catalago_productos,
                catalago_precio,
                descripcion,
                activo
            FROM productos 
            WHERE id_producto = :productId
        ";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':productId', $producId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
    
}
