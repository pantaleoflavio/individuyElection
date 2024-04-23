<?php

namespace App\DAO;

use App\Core\DB;
use App\Models\Wrestler;
use PDO;
use PDOException;

class WrestlerDAO extends DB {

    public function getSingleWrestlerPerId($id) {
        try {
            // Aggiunta di w.is_active alla SELECT query
            $stmt = $this->connect()->prepare("SELECT w.id_wrestler, w.name, w.country, w.category_id, w.federation_id, f.name AS federation, w.is_active
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
                    $wrestlerDB['federation_id'],
                    $wrestlerDB['is_active'] // Assicurati che questo campo sia correttamente inserito nell'oggetto Wrestler
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("PDOException in getSingleWrestlerPerId: " . $e->getMessage());
            return null;
        }
    }
    
    public function getAllWrestlers($includeInactive = false) {
        $sql = "SELECT w.id_wrestler, w.name, w.country, IFNULL(c.name, 'Pesi Massimi') AS category_name, f.name AS federation_name, w.federation_id, w.is_active 
                FROM wrestlers w
                LEFT JOIN categories c ON w.category_id = c.category_id
                LEFT JOIN federations f ON w.federation_id = f.id_federation";
        if (!$includeInactive) {
            $sql .= " WHERE w.is_active = 1";
        }
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    
    
    public function updateWrestler($id, $name, $country, $categoryId, $federationId, $is_active) {
        try {
            $sql = "UPDATE wrestlers SET name = ?, country = ?, category_id = ?, federation_id = ?, is_active = ? WHERE id_wrestler = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $country, $categoryId, $federationId, $is_active, $id]);
            return $stmt->rowCount();  // Restituisce il numero di righe modificate
        } catch (PDOException $e) {
            error_log("PDOException in updateWrestler: " . $e->getMessage());
            return false;  // Restituisce false in caso di errore
        }
    }

    public function addWrestler($name, $country, $categoryId, $federationId, $isActive) {
        try {
            $sql = "INSERT INTO wrestlers (name, country, category_id, federation_id, is_active) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $country, $categoryId, $federationId, $isActive]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("PDOException in addWrestler: " . $e->getMessage());
            return false;
        }
    }
    

    
}
