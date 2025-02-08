<?php

require_once '../model/dbo.php';

class CategoryModel
{
    public function fetchCategories()
    { {
            $db = new database();
            $conn = $db->getConnection();

            $query = "SELECT id_catalago_productos, descripcion, activo FROM catalago_productos WHERE activo = 1";
            $stmt = $conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function fetchPrice()
    {
        $db = new database();
        $conn = $db->getConnection();

        $query = 'SELECT id_catalago_precio, precio FROM catalago_precio WHERE activo = 1';
        $stmt  = $conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategoryProduct($categoryName)
    {
        try {
            $db = new database();
            $conn = $db->getConnection();

            $query = "
        INSERT INTO catalago_productos
        (descripcion, activo) 
        VALUES (:categoryName, 1)";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':categoryName', $categoryName);
            $stmt->execute();
            return [
                'success' => true,
                'message' => 'Category added successfully'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
    public function addCategoryPrice($price)
    {
        try {
            $db = new database();
            $conn = $db->getConnection();

            $query = "
        INSERT INTO catalago_precio
        (precio, activo) 
        VALUES (:price, 1)";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':price', $price);
            $stmt->execute();
            return [
                'success' => true,
                'message' => 'Category added successfully'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
    public function getCategoryMethodPayment()
    {
        try{
            $db = new database();
            $conn = $db->getConnection();

            $query = "SELECT * FROM metodo_pago";
            $stmt  = $conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            return [
                'success' => false,
               'message' => 'Error: '. $e->getMessage()
            ];
        }
    }
}
