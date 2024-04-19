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

    public function getAllWrestlers() {
        try {
            $sql = "SELECT w.id_wrestler, w.name, w.country, 
                        IFNULL(c.name, 'Pesi Massimi') AS category_name, 
                        f.name AS federation_name
                    FROM wrestlers w
                    LEFT JOIN categories c ON w.category_id = c.category_id
                    LEFT JOIN federations f ON w.federation_id = f.id_federation";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDOException in getAllWrestlers: " . $e->getMessage());
            return [];
        }
    }

    public function getAllWrestlersPerCategory($categoryId) {
        $sql = "SELECT w.id_wrestler, w.name, w.country, w.federation_id, f.name AS federation
                FROM wrestlers w
                LEFT JOIN federations f ON w.federation_id = f.id_federation
                WHERE w.category_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWrestlersByFederation($federationId) {
        try {
            $stmt = $this->connect()->prepare("SELECT w.id_wrestler, w.name, w.country, f.name AS federation
                                               FROM wrestlers w
                                               LEFT JOIN federations f ON w.federation_id = f.id_federation
                                               WHERE w.federation_id = ?");
            $stmt->execute([$federationId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDOException in getWrestlersByFederation: " . $e->getMessage());
            return [];
        }
    }
    
    
    public function updateWrestler($id, $name, $country, $categoryId, $federationId) {
        try {
            $sql = "UPDATE wrestlers SET name = ?, country = ?, category_id = ?, federation_id = ? WHERE id_wrestler = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $country, $categoryId, $federationId, $id]);
            return $stmt->rowCount();  // Restituisce il numero di righe modificate
        } catch (PDOException $e) {
            error_log("PDOException in updateWrestler: " . $e->getMessage());
            return false;  // Restituisce false in caso di errore
        }
    }

    public function addWrestler($name, $country, $categoryId, $federationId) {
        try {
            $sql = "INSERT INTO wrestlers (name, country, category_id, federation_id) VALUES (?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $country, $categoryId, $federationId]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("PDOException in addWrestler: " . $e->getMessage());
            return false;
        }
    }
    

    
}
