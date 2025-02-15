<?php

require_once __DIR__ . '/../../model/dbo.php';

class inventoryModel
{

    public function getInventory()
    {

        try {

            $db = new database();
            $conn = $db->getConnection();

            $query = "
            SELECT 
                i.id_inventario AS id,
                p.nombre_producto AS product,
                i.cantidad AS quantity,
                i.activo AS status,
                DATE(i.fecha_restock) AS restock_date,
                TIME(i.fecha_restock) AS restock_time
            FROM inventario i
            JOIN productos p ON i.productos_id = p.id_producto
            JOIN catalago_productos cp ON p.catalago_productos = cp.id_catalago_productos
            WHERE cp.id_catalago_productos <> 1
            ";

            $stmt = $conn->query($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    public function insertInventory($productId, $quantity, $date, $time)
    {
        try {
            $db = new database();
            $conn = $db->getConnection();

            $fechaRestock = $date . ' ' . $time;

            $checkQuery = "SELECT COUNT(*) FROM inventario WHERE productos_id = :productId";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bindParam(':productId', $productId);
            $checkStmt->execute();
            $productExists = $checkStmt->fetchColumn(); // Retorna el número de filas encontradas

            if ($productExists > 0) {
                return [
                    'success' => false,
                    'message' => 'El producto ya está registrado en el inventario.'
                ];
            }

            // Si no existe, procede con el INSERT
            $query = "
            INSERT INTO inventario (productos_id, cantidad, activo, fecha_restock)
            VALUES (:productId, :quantity, 1, :fechaRestock)";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':productId', $productId);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':fechaRestock', $fechaRestock);
            $stmt->execute();

            return [
                'success' => true,
                'message' => 'Inventario agregado correctamente'
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
            SELECT p.id_producto, p.nombre_producto
            FROM productos p
            JOIN catalago_productos cp ON p.catalago_productos = cp.id_catalago_productos
            WHERE p.activo = 1 AND cp.id_catalago_productos <> 1
            "; 

            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    public function InventoryRestock($id_inventario, $quantity, $date, $time)
    {
        try {
            $db = new database();
            $conn = $db->getConnection();

            $fechaRestock = $date . ' ' . $time;

            $query = "
            UPDATE inventario 
            SET cantidad = cantidad + :quantity, 
                fecha_restock = :fechaRestock
            WHERE id_inventario = :id_inventario";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':fechaRestock', $fechaRestock);
            $stmt->bindParam(':id_inventario', $id_inventario);
            $stmt->execute();

            return [
                'success' => true,
                'message' => 'Inventario actualizado correctamente'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
    public function deleteProduct($id_inventario)
    {
        try {
            $db = new database();
            $conn = $db->getConnection();

            $query = "DELETE FROM inventario WHERE id_inventario = :id_inventario";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_inventario', $id_inventario);
            $stmt->execute();

            return [
                'success' => true,
                'message' => 'Registro eliminado correctamente'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    public function getInventorySummary()
    {
        try
        {
            $db = new database();
            $conn = $db->getConnection();

            $query = "
            SELECT
            p.nombre_producto AS product,
            SUM(i.cantidad) AS total_quantity
            FROM inventario i
            JOIN productos p ON i.productos_id = p.id_producto
            JOIN catalago_productos cp ON p.catalago_productos = cp.id_catalago_productos
            WHERE cp.id_catalago_productos <> 1
            GROUP BY p.nombre_producto";

            $stmt = $conn->query($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }


    }
    

}



// id_inventario
// productos_id
// cantidad
// activo
// fecha_restock