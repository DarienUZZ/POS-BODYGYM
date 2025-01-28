<?php

require_once '../model/dbo.php';

class CategoryModel
{
    public function fetchCategories()
    { {
            $db = new database();
            $conn = $db->getConnection();

            $query = "SELECT id_catalago_productos, descripcion FROM catalago_productos WHERE activo = 1";
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
}
