<?php 

class PagesController
{
    public function index()
    {
        include "view/dashboard.php";
    }

    public function login()
    {
        include "view/login.php";
    }

    public function products()
    {
        include "view/products.php";
    }

    public function addProducts()
    {
        include "view/addProducts.php";
    }

    public function categories()
    {
        include "view/categories.php";
    }

    public function prices()
    {
        include "view/prices.php";
    }

    public function error404()
    {
        include "view/error404.php";
    }

    public function sales()
    {
        include "view/sales.php";
    }

    public function users()
    {
        include "view/users.php";
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("location: /POS-BODYGYM/");
    }
}