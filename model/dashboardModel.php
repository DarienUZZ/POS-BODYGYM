<?php

require_once '../model/dbo.php';

class dashboardModel{

    static public function fetchDashboardData() {

        $db = new database();
        $conn = $db->getConnection();

        $data = [];

        // Total de productos
        $queryProducts = "SELECT COUNT(*) AS totalProducts FROM productos WHERE activo = 1";
        $resultProducts = $conn->query($queryProducts);
        $data['totalProducts'] = $resultProducts->fetchColumn();

        // Ventas diarias
        $queryDailySales = 'SELECT COUNT(*) AS totalSales FROM factura WHERE DATE(fecha) = CURDATE()';
        $resultDailySales = $conn->query($queryDailySales);
        $data['dailySales'] = $resultDailySales->fetchColumn();

        $queryLowStock = "
        SELECT COUNT(*) AS lowStock 
            FROM inventario i
            INNER JOIN productos p ON i.productos_id = p.id_producto
            INNER JOIN catalago_productos cp ON p.catalago_productos = cp.id_catalago_productos
            WHERE i.cantidad < 8 
            AND i.activo = 1
            AND cp.id_catalago_productos <> 1";
        $resultLowStock = $conn->query($queryLowStock);
        $data['lowStockProducts'] = $resultLowStock->fetchColumn();

        return $data;


        
    }
}