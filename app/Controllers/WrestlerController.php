<?php

namespace App\Controllers;

use App\Core\DB;
use PDO;
use PDOException;
use App\Models\Wrestler;

class WrestlerController extends DB {
    
    public function getSingleWrestlerPerId($id) {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM wrestlers WHERE id_wrestler = ?");
            $stmt->execute([$id]);
            $wrestlerDB = $stmt->fetchAll((PDO::FETCH_ASSOC));
            $wrestler = new wrestler($wrestlerDB[0]['id_wrestler'], $wrestlerDB[0]['name'], $wrestlerDB[0]['height'], $wrestlerDB[0]['weight'], $wrestlerDB[0]['continent'], $wrestlerDB[0]['country']);   
            $stmt = null;
            return $wrestler;

        } catch (PDOException $e) {
            // Gestione degli errori, come log o messaggio di errore.

            error_log("Errore durante il recupero del wrestler " . $e->getMessage());
            return [];
        }
    }
    
    public function getAllWrestlers() {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM wrestlers");
            $stmt->execute();
            $wrestlers = $stmt->fetchAll((PDO::FETCH_OBJ));
            $stmt = null;
            return $wrestlers;

        } catch (PDOException $e) {
            // Gestione degli errori, come log o messaggio di errore.

            error_log("Errore durante il recupero del wrestler " . $e->getMessage());
            return [];
        }
    }
    public function getAllWrestlersPerCategory($id) {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM wrestlers WHERE category_id = ?");
            $stmt->execute([$id]);
            $wrestlers = $stmt->fetchAll((PDO::FETCH_OBJ));
            $stmt = null;
            return $wrestlers;

        } catch (PDOException $e) {
            // Gestione degli errori, come log o messaggio di errore.

            error_log("Errore durante il recupero del wrestler " . $e->getMessage());
            return [];
        }
    }



    

    
}

?>