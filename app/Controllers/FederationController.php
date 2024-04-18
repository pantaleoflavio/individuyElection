<?php

namespace App\Controllers;

use App\DAO\FederationDAO;

class FederationController {
    
    private $federationDAO;

    public function __construct() {
        $this->federationDAO = new FederationDAO(); // Inizializza DAO
    }

    public function getFederationPerId($id) {
        return $this->federationDAO->getFederationPerId($id);
    }

    public function getAllFederations() {
        return $this->federationDAO->getAllFederations();
    }

    public function getWrestlersCountPerFederation() {
        return $this->federationDAO->getWrestlersCountPerFederation();
    }
    

}
