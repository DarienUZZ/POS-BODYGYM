<?php
require_once '../controller/dashboardController.php';

$dashboardController = new DashboardController();
$data = $dashboardController->getDashboardData();

echo json_encode($data);
