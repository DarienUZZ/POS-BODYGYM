<?php

require_once '../model/dbo.php';

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
                i.fecha_restock AS restock
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
        try{
            $db = new database();
            $conn = $db->getConnection();

            $fechaRestock = $date . ' ' . $time;

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
        }catch(Exception $e){
            return [
                'success' => false,
               'message' => 'Error: '. $e->getMessage()
            ];
        }
    }
    // funcion para eidtar el inventario que lo unico que edite sea la cantidad y la fecha, no dejar editar el nombre ni status
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
        "; // Ajusta la consulta según tu estructura

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

}



// id_inventario
// productos_id
// cantidad
// activo
// fecha_restock