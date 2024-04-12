<?php

namespace App\Controllers;

use App\Core\DB;
use PDO;
use PDOException;
use App\Models\Category;

class CategoryController extends DB {
    
    public function getAllCategories() {
        $stmt = $this->connect()->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getSingleCategory($id) {
        $stmt = $this->connect()->prepare("SELECT * FROM categories where category_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}

?>