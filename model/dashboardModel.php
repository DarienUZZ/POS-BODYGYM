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

        $queryLowStock = 'SELECT COUNT(*) AS lowStock FROM inventario WHERE cantidad < 8 AND activo = 1';
        $resultLowStock = $conn->query($queryLowStock);
        $data['lowStockProducts'] = $resultLowStock->fetchColumn();

        return $data;


        
    }
}