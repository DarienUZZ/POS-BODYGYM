<?php

require_once '../model/products/CategoryModel.php';

class CategoryController{

    public function getCategories(){
        $categoryModel = new CategoryModel();
        return $categoryModel->fetchCategories();
    }

    public function getPrice()
    {
        $categoryModel = new CategoryModel();
        return $categoryModel->fetchPrice();
    }
}