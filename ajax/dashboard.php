<?php
require_once '../controller/dashboardController.php';

$dashboardController = new DashboardController();
$data = $dashboardController->getDashboardData();


header('Content-Type: application/json');
echo json_encode($data);
exit;
