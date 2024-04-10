<?php

namespace App\Controllers;

use App\Core\DB;
use PDO;
use PDOException;
use App\Models\Ranking;

class RankingController extends DB {
    
    public function getAllRanking() {
        $stmt = $this->connect()->prepare("SELECT * FROM votes_categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getRankingPerCategory($category) {
        $stmt = $this->connect()->prepare("SELECT * FROM votes_categories WHERE ranking = ?");
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    
}

?>