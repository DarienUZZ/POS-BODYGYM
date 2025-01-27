<?php

require_once '../model/dashboardModel.php';

class dashboardController{

    public function getDashboardData(){

        $dashboardModel = new dashboardModel();
        return $dashboardModel->fetchDashboardData();
        
    }
}