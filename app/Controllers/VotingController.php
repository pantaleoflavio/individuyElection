<?php

namespace App\Controllers;

use App\Core\DB;
use PDO;

class VotingController extends DB {

    public function getDettagliVotazione($idCategoria) {
        $sql = "SELECT * FROM categoria_votazione_mappatura WHERE id_votes_category = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$idCategoria]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCandidatiPerCategoria($tabellaAssociata, $idCategoria) {
        // Assicurati che $tabellaAssociata sia un valore fidato prima di includerlo nella query
        $sql = "SELECT * FROM {$tabellaAssociata} WHERE id_vote_category = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$idCategoria]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


}