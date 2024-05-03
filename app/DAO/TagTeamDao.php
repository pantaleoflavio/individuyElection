<?php

namespace App\DAO;

use App\Core\DB;
use App\Models\Wrestler;
use PDO;
use PDOException;

class TagTeamDAO extends DB {

    public function getTagTeamPerId($id) {
        try {
            
            $stmt = $this->connect()->prepare("SELECT tt.id_tag_team, tt.name, tt.country, tt.category_id, tt.federation_id, f.name AS federation, tt.is_active
                                              FROM tag_teams tt
                                              LEFT JOIN federations f ON tt.federation_id = f.id_federation
                                              WHERE tt.id_tag_team = ?");
            $stmt->execute([$id]);
            $tagTeamDB = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($tagTeamDB) {
                return new Wrestler(
                    $tagTeamDB['id_tag_team'], 
                    $tagTeamDB['name'], 
                    $tagTeamDB['country'], 
                    $tagTeamDB['category_id'],
                    $tagTeamDB['federation_id'],
                    $tagTeamDB['is_active']
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("PDOException in getTagTeamPerId: " . $e->getMessage());
            return null;
        }
    }
    
    public function getAllTagTeams($includeInactive = false) {
        $sql = "SELECT tt.id_tag_team, tt.name, tt.country, IFNULL(c.name, 'Pesi Massimi') AS category_name, f.name AS federation_name, tt.federation_id, tt.is_active 
                FROM tag_teams tt
                LEFT JOIN categories c ON tt.category_id = c.category_id
                LEFT JOIN federations f ON tt.federation_id = f.id_federation";
        if (!$includeInactive) {
            $sql .= " WHERE tt.is_active = 1";
        }
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
    

    public function getAllTagTeamsPerCategory($categoryId) {
        $sql = "SELECT tt.id_tag_team, tt.name, tt.country, w.federation_id, f.name AS federation
                FROM tag_teams tt
                LEFT JOIN federations f ON tt.federation_id = f.id_federation
                WHERE tt.category_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTagTeamsByFederation($federationId) {
        try {
            $stmt = $this->connect()->prepare("SELECT tt.id_tag_team, tt.name, tt.country, f.name AS federation
                                               FROM tag_teams tt
                                               LEFT JOIN federations f ON tt.federation_id = f.id_federation
                                               WHERE tt.federation_id = ?");
            $stmt->execute([$federationId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDOException in getTagTeamsByFederation: " . $e->getMessage());
            return [];
        }
    }
    
    
    public function updateTagTeam($id, $name, $country, $categoryId, $federationId, $is_active) {
        try {
            $sql = "UPDATE tag_teams SET name = ?, country = ?, category_id = ?, federation_id = ?, is_active = ? WHERE id_tag_team = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $country, $categoryId, $federationId, $is_active, $id]);
            return $stmt->rowCount();  // Restituisce il numero di righe modificate
        } catch (PDOException $e) {
            error_log("PDOException in updateTagTeam: " . $e->getMessage());
            return false;  // Restituisce false in caso di errore
        }
    }

    public function addTagTeam($name, $country, $categoryId, $federationId, $isActive) {
        try {
            $sql = "INSERT INTO tag_teams (name, country, category_id, federation_id, is_active) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $country, $categoryId, $federationId, $isActive]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("PDOException in addTagTeam: " . $e->getMessage());
            return false;
        }
    }
    
    public function deleteTagTeam($id) {
        try {
            $stmt = $this->connect()->prepare("DELETE FROM tag_teams WHERE id_tag_team = ?");
            $stmt->execute([$id]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("PDOException in deleteTagTeam: " . $e->getMessage());
            return false;
        }
    }
    
}
