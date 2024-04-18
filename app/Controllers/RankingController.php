<?php

namespace App\Controllers;

use App\DAO\RankingDAO;

class RankingController {
    
    private $rankingDAO;

    public function __construct() {
        $this->rankingDAO = new RankingDAO(); // Inizializza RankingDAO
    }

    public function getAllRanking() {
        return $this->rankingDAO->getAllRanking();
    }

    public function getRankingPerCategory($category) {
        return $this->rankingDAO->getRankingPerCategory($category);
    }
    
    public function getRankingPerId($id) {
        return $this->rankingDAO->getRankingPerId($id);
    }

    public function getRankingDetails($idRanking) {
        return $this->rankingDAO->getRankingDetailsWithScores($idRanking);
    }

    public function getRankingsWithTotalScores() {
        return $this->rankingDAO->getRankingsWithTotalScores();
    }
}
