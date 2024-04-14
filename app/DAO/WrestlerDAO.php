<?php

namespace App\DAO;

use App\Core\DB;
use App\Models\Wrestler;
use PDO;
use PDOException;

class WrestlerDAO extends DB {
    
    public function getSingleWrestlerPerId($id) {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM wrestlers WHERE id_wrestler = ?");
            $stmt->execute([$id]);
            $wrestlerDB = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($wrestlerDB) {
                return new Wrestler(
                    $wrestlerDB['id_wrestler'], 
                    $wrestlerDB['name'], 
                    $wrestlerDB['country'], 
                    $wrestlerDB['category_id'],
                    $wrestlerDB['federation_id']
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("PDOException in getSingleWrestlerPerId: " . $e->getMessage());
            return null;
        }
    }

    public function getAllWrestlers() {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM wrestlers");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDOException in getAllWrestlers: " . $e->getMessage());
            return [];
        }
    }

    public function getAllWrestlersPerCategory($categoryId) {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM wrestlers WHERE category_id = ?");
            $stmt->execute([$categoryId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDOException in getAllWrestlersPerCategory: " . $e->getMessage());
            return [];
        }
    }
}
