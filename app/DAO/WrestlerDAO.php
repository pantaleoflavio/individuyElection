<?php

namespace App\DAO;

use App\Core\DB;
use App\Models\Wrestler;
use PDO;
use PDOException;

class WrestlerDAO extends DB {

    public function getSingleWrestlerPerId($id) {
        try {
            $stmt = $this->connect()->prepare("SELECT w.id_wrestler, w.name, w.country, w.category_id, w.federation_id, f.name AS federation
                                              FROM wrestlers w
                                              LEFT JOIN federations f ON w.federation_id = f.id_federation
                                              WHERE w.id_wrestler = ?");
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

    public function getAllWrestlers($order = 'name') {
        try {
            $sql = "SELECT * FROM wrestlers" . $this->getOrderByClause($order);
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDOException in getAllWrestlers: " . $e->getMessage());
            return [];
        }
    }

    public function getAllWrestlersPerCategory($categoryId, $order) {
        $sql = "SELECT w.id_wrestler, w.name, w.country, w.federation_id, f.name AS federation
                FROM wrestlers w
                LEFT JOIN federations f ON w.federation_id = f.id_federation
                WHERE w.category_id = ?";
        $sql .= $this->getOrderByClause($order);
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    private function getOrderByClause($order) {
        switch ($order) {
            case 'name':
                return " ORDER BY name";
            case 'country':
                return " ORDER BY country";
            default:
                return " ORDER BY name";  // Default
        }
    }
}
