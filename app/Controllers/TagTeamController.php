<?php

namespace App\Controllers;

use App\DAO\TagTeamDAO;

class TagTeamController {
    
    private $TagTeamDAO;

    public function __construct() {
        $this->TagTeamDAO = new TagTeamDAO(); // Inizializza DAO
    }

    public function getTagTeamPerId($id) {
        return $this->TagTeamDAO->getTagTeamPerId($id);
    }

    public function getAllTagTeamsPerCategory($categoryId, $order = 'name') {
        return $this->TagTeamDAO->getAllTagTeamsPerCategory($categoryId, $order);
    }
    
    public function getAllTagTeams($order = 'name') {
        return $this->TagTeamDAO->getAllTagTeams($order);
    }

    public function getTagTeamsByFederation($federationId) {
        return $this->TagTeamDAO->getTagTeamsByFederation($federationId);
    }

    public function updateTagTeam($id, $name, $country, $categoryId, $federationId, $is_active) {
        return $this->TagTeamDAO->updateTagTeam($id, $name, $country, $categoryId, $federationId, $is_active);
    }

    public function addTagTeam($name, $country, $categoryId, $federationId, $isActive) {
        return $this->TagTeamDAO->addTagTeam($name, $country, $categoryId, $federationId, $isActive);
    }

    public function deleteTagTeam($id) {
        return $this->TagTeamDAO->deleteTagTeam($id);
    }
    
}
