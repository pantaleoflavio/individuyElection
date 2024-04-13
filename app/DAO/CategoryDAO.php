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
            // Restituisce un array di oggetti Category
            $categories = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = new Category($row['category_id'], $row['name']);
            }
            return $categories;
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
