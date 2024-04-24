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

    public function addFederation($name, $description) {
        return $this->federationDAO->addFederation($name, $description);
    }

    public function updateFederation($id, $name, $description) {
        return $this->federationDAO->updateFederation($id, $name, $description);
    }
    
    public function deleteFederation($id) {
        return $this->federationDAO->deleteFederation($id);
    }
    

}
