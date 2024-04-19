<?php

namespace App\Controllers;

use App\DAO\WrestlerDAO;

class WrestlerController {
    
    private $wrestlerDAO;

    public function __construct() {
        $this->wrestlerDAO = new WrestlerDAO(); // Inizializza DAO
    }

    public function getSingleWrestlerPerId($id) {
        return $this->wrestlerDAO->getSingleWrestlerPerId($id);
    }

    public function getAllWrestlersPerCategory($categoryId, $order = 'name') {
        return $this->wrestlerDAO->getAllWrestlersPerCategory($categoryId, $order);
    }
    
    public function getAllWrestlers($order = 'name') {
        return $this->wrestlerDAO->getAllWrestlers($order);
    }

    public function getWrestlersByFederation($federationId) {
        return $this->wrestlerDAO->getWrestlersByFederation($federationId);
    }

    public function updateWrestler($id, $name, $country, $categoryId, $federationId) {
        return $this->wrestlerDAO->updateWrestler($id, $name, $country, $categoryId, $federationId);
    }
    public function addWrestler($name, $country, $categoryId, $federationId) {
        return $this->wrestlerDAO->addWrestler($name, $country, $categoryId, $federationId);
    }
    
}
