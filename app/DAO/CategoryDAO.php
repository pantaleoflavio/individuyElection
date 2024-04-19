<?php

namespace App\DAO;

use App\Core\DB;
use App\Models\Category;
use PDO;
use PDOException;

class CategoryDAO extends DB {
    
    // Metodo per ottenere tutte le categorie
    public function getAllCategories() {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM categories");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDOException in getAllCategories: " . $e->getMessage());
            return [];
        }
    }

    // Metodo per ottenere una singola categoria per ID
    public function getSingleCategory($id) {
        $stmt = $this->connect()->prepare("SELECT * FROM categories WHERE category_id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? new Category($data['category_id'], $data['name']) : null;
    }
}
