<?php

namespace App\DAO;

use App\Core\DB;
use App\Models\Ranking;
use PDO;
use PDOException;

class RankingDAO extends DB {
    
    public function getAllRanking() {
        try {
            $stmt = $this->connect()->prepare("SELECT id_ranking, ranking_name, description, ranking, status, category_id, include_inactive FROM list_ranking");
            $stmt->execute();
            $rankings = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $rankings[] = new Ranking(
                    $row['id_ranking'],
                    $row['ranking_name'],
                    $row['description'],
                    $row['ranking'],  // Aggiunto
                    $row['status'],
                    $row['category_id'],
                    $row['include_inactive']
                );
            }
            return $rankings;
        } catch (PDOException $e) {
            error_log("PDOException in getAllRanking: " . $e->getMessage());
            return [];
        }
    }
    
    public function getRankingPerCategory($category) {
        try {
            $stmt = $this->connect()->prepare("SELECT id_ranking, ranking_name, description, ranking, status, category_id, include_inactive FROM list_ranking WHERE ranking = ?");
            $stmt->execute([$category]);
            $rankings = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $rankings[] = new Ranking(
                    $row['id_ranking'],
                    $row['ranking_name'],
                    $row['description'],
                    $row['ranking'],  // Aggiunto
                    $row['status'],
                    $row['category_id'],
                    $row['include_inactive']
                );
            }
            return $rankings;
        } catch (PDOException $e) {
            error_log("PDOException in getRankingPerCategory: " . $e->getMessage());
            return [];
        }
    }
    

    public function getRankingPerId($id) {
        try {
            // Aggiunta di `ranking` alla selezione
            $stmt = $this->connect()->prepare("SELECT id_ranking, ranking_name, description, ranking, status, category_id, include_inactive FROM list_ranking WHERE id_ranking = ?");
            $stmt->execute([$id]);
            $rankingData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($rankingData) {
                $ranking = new Ranking(
                    $rankingData['id_ranking'],
                    $rankingData['ranking_name'],
                    $rankingData['description'],
                    $rankingData['ranking'],
                    $rankingData['status'],
                    $rankingData['category_id'],
                    $rankingData['include_inactive']
                );
                return $ranking;
            }
            return null;
        } catch (PDOException $e) {
            error_log("PDOException in getRankingPerId: " . $e->getMessage());
            return null;
        }
    }
    

    public function getRankingDetailsWithScores($idRanking) {
        try {
            $sql = "SELECT 
                        CASE 
                            WHEN v.id_wrestler IS NOT NULL THEN w.id_wrestler
                            WHEN v.id_tag_team IS NOT NULL THEN tt.id_tag_team
                            WHEN v.id_federation IS NOT NULL THEN f.id_federation
                        END AS id,
                        CASE 
                            WHEN v.id_wrestler IS NOT NULL THEN w.name
                            WHEN v.id_tag_team IS NOT NULL THEN tt.name
                            WHEN v.id_federation IS NOT NULL THEN f.name
                        END AS name,
                        AVG(v.score) as averageScore
                    FROM 
                        votes v
                    LEFT JOIN 
                        wrestlers w ON v.id_wrestler = w.id_wrestler AND v.id_wrestler IS NOT NULL
                    LEFT JOIN 
                        tag_teams tt ON v.id_tag_team = tt.id_tag_team AND v.id_tag_team IS NOT NULL
                    LEFT JOIN 
                        federations f ON v.id_federation = f.id_federation AND v.id_federation IS NOT NULL
                    WHERE 
                        v.id_ranking = ?
                    GROUP BY 
                        id, name
                    ORDER BY 
                        averageScore DESC";
            
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$idRanking]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log("PDOException in getRankingDetailsWithScores: " . $e->getMessage());
            return [];
        }
    }
    
    
    public function getRankingsWithTotalScores() {
        try {
            $sql = "SELECT r.id_ranking, r.ranking_name, COUNT(v.id_votes) AS total_votes
                    FROM list_ranking r
                    LEFT JOIN votes v ON r.id_ranking = v.id_ranking
                    GROUP BY r.id_ranking, r.ranking_name
                    ORDER BY r.id_ranking";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDOException in getRankingsWithTotalScores: " . $e->getMessage());
            return [];
        }
    }

    public function addRanking($rankingName, $description, $rankingType, $status, $categoryId, $includeInactive) {
        try {
            $sql = "INSERT INTO list_ranking (ranking_name, description, ranking, status, category_id, include_inactive) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            return $stmt->execute([$rankingName, $description, $rankingType, $status, $categoryId, $includeInactive]);
        } catch (PDOException $e) {
            error_log("PDOException in addRanking: " . $e->getMessage());
            return false;
        }
    }
    
    public function isRankingIncludingInactive($id_ranking) {
        $sql = "SELECT include_inactive FROM list_ranking WHERE id_ranking = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id_ranking]);
        $includeInactive = $stmt->fetchColumn();
        return $includeInactive;
    }

    public function updateRanking($id, $rankingName, $description, $rankingType, $status, $categoryId, $includeInactive) {
        try {
            $sql = "UPDATE list_ranking SET ranking_name = ?, description = ?, ranking = ?, status = ?, category_id = ?, include_inactive = ? WHERE id_ranking = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([ $rankingName, $description, $rankingType, $status, $categoryId, $includeInactive, $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("PDOException in updateRanking: " . $e->getMessage());
            return false;
        }
    }
    
    public function deleteRanking($id) {
        try {
            $stmt = $this->connect()->prepare("DELETE FROM list_ranking WHERE id_ranking = ?");
            $stmt->execute([$id]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("PDOException in deleteRanking: " . $e->getMessage());
            return false;
        }
    }

}
