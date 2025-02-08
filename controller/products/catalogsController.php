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

    public function addCategoryProduct($categoryName)
    {
        $categoryModel = new CategoryModel();
        return $categoryModel->addCategoryProduct($categoryName);
    }

    public function addCategoryPrice($price)
    {
        $categoryModel = new CategoryModel();
        return $categoryModel->addCategoryPrice($price);
    }
    public function getCategoryMethodPayment()
    {
        $categoryModel = new CategoryModel();
        return $categoryModel->getCategoryMethodPayment();
    }
}