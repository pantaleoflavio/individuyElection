<?php

namespace App\Controllers;

use App\DAO\WrestlerDAO;

class WrestlerController {
    
    private $wrestlerDAO;

    public function __construct() {
        $this->wrestlerDAO = new WrestlerDAO(); // Inizializza WrestlerDAO
    }

    public function getSingleWrestlerPerId($id) {
        return $this->wrestlerDAO->getSingleWrestlerPerId($id);
    }

    public function getAllWrestlers() {
        return $this->wrestlerDAO->getAllWrestlers();
    }

    public function getAllWrestlersPerCategory($categoryId) {
        return $this->wrestlerDAO->getAllWrestlersPerCategory($categoryId);
    }
}
