<?php

namespace App\Controllers;

use App\DAO\CategoryDAO;

class CategoryController {
    
    private $categoryDAO;

    public function __construct() {
        $this->categoryDAO = new CategoryDAO(); // Inizializza CategoryDAO
    }

    public function getAllCategories() {
        return $this->categoryDAO->getAllCategories();
    }

    public function getSingleCategory($id) {
        return $this->categoryDAO->getSingleCategory($id);
    }

    public function addCategory($name) {
        return $this->categoryDAO->addCategory($name);
    }

    public function updateCategory($id, $name) {
        return $this->categoryDAO->updateCategory($id, $name);
    }
    
}
