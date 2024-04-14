<?php

namespace App\Controllers;

use App\DAO\FederationDAO;

class FederationController {
    
    private $wrestlerDAO;

    public function __construct() {
        $this->wrestlerDAO = new FederationDAO(); // Inizializza DAO
    }

    public function getFederationPerId($id) {
        return $this->wrestlerDAO->getFederationPerId($id);
    }

}
