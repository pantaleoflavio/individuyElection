<?php

namespace App\DAO;

use App\Core\DB;
use App\Models\Ranking;
use PDO;
use PDOException;

class RankingDAO extends DB {
    
    public function getAllRanking() {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM list_ranking");
            $stmt->execute();
            $rankings = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $rankings[] = new Ranking($row['id_ranking'], $row['ranking_name'], $row['description'], $row['status'], $row['category_id']);
            }
            return $rankings;
        } catch (PDOException $e) {
            error_log("PDOException in getAllRanking: " . $e->getMessage());
            return [];
        }
    }

    public function getRankingPerCategory($category) {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM list_ranking WHERE ranking = ?");
            $stmt->execute([$category]);
            $rankings = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $rankings[] = new Ranking($row['id_ranking'], $row['ranking_name'], $row['description'], $row['status'], $row['category_id']);
            }
            return $rankings;
        } catch (PDOException $e) {
            error_log("PDOException in getRankingPerCategory: " . $e->getMessage());
            return [];
        }
    }

    public function getRankingPerId($id) {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM list_ranking WHERE id_ranking = ?");
            $stmt->execute([$id]);
            $rankingData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($rankingData) {
                $ranking = new Ranking(
                    $rankingData['id_ranking'],
                    $rankingData['ranking_name'],
                    $rankingData['description'],
                    $rankingData['status'],
                    $rankingData['category_id']
                );
                return $ranking;
            }
            return null;
        } catch (PDOException $e) {
            error_log("PDOException in getRankingPerId: " . $e->getMessage());
            return null;
        }
    }

}
