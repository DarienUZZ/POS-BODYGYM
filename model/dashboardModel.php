<?php
require_once 'dbo.php';

class DashboardModel
{
    static public function fetchDashboardData()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $data = [];

        // Total de productos (adaptado para Supabase)
        $productsData = $db->executeQuery('productos', [
            'select' => ['count' => 'exact'],
            'eq' => ['activo', 1]
        ]);
        $data['totalProducts'] = $productsData ? count($productsData) : 0;

        // Ventas diarias (adaptado)
        $today = date('Y-m-d');
        $salesData = $db->executeQuery('factura', [
            'select' => ['count' => 'exact'],
            'eq' => ['fecha', $today]
        ]);
        $data['dailySales'] = $salesData ? count($salesData) : 0;

        // Productos con bajo stock (adaptado)
        $lowStockData = $db->executeQuery('inventario', [
            'select' => ['count' => 'exact'],
            'lt' => ['cantidad', 8],
            'eq' => ['activo', 1]
        ]);
        $data['lowStockProducts'] = $lowStockData ? count($lowStockData) : 0;

        return $data;
    }
}
