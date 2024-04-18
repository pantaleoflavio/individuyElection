<?php

namespace App\DAO;

use App\Core\DB;
use App\Models\Federation;
use PDO;
use PDOException;

class FederationDAO extends DB {
    
    public function getFederationPerId($id) {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM federations WHERE id_federation = ?");
            $stmt->execute([$id]);
            $federationDB = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($federationDB) {
                return new Federation(
                    $federationDB['id_federation'], 
                    $federationDB['name'], 
                    $federationDB['description']
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("PDOException in getFederationPerId: " . $e->getMessage());
            return null;
        }
    }

    public function getAllFederations() {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM federations");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDOException in getAllFederations: " . $e->getMessage());
            return [];
        }
    }

    public function getWrestlersCountPerFederation() {
        try {
            $sql = "SELECT f.id_federation, f.name, COUNT(w.id_wrestler) AS total_wrestlers
                    FROM federations f
                    LEFT JOIN wrestlers w ON f.id_federation = w.federation_id
                    GROUP BY f.id_federation, f.name";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDOException in getWrestlersCountPerFederation: " . $e->getMessage());
            return [];
        }
    }

}
