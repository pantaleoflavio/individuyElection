<?php

namespace App\DAO;

use App\Core\DB;
use App\Models\Vote;
use PDO;
use PDOException;

class VoteDAO extends DB {

    public function saveVote(Vote $vote) {
        $sql = "INSERT INTO votes (id_ranking, id_wrestler, id_tag_team, id_user, score, year) VALUES (:idRanking, :idWrestler, :idTagTeam, :idUser, :score, :year)";
        try {
        $stmt = $this->connect()->prepare($sql);
        
        // Collega i valori del modello Vote ai parametri SQL usando il metodo bindValue
        $stmt->bindValue(':idRanking', $vote->idRanking, PDO::PARAM_INT);
        $stmt->bindValue(':idWrestler', $vote->idWrestler, PDO::PARAM_INT);
        $stmt->bindValue(':idTagTeam', $vote->idTagTeam, PDO::PARAM_INT);
        $stmt->bindValue(':idUser', $vote->idUser, PDO::PARAM_INT);
        $stmt->bindValue(':score', $vote->score, PDO::PARAM_STR);
        $stmt->bindValue(':year', $vote->year, PDO::PARAM_INT);

        // Esegui la query e gestisci eventuali eccezioni/errori
        $stmt->execute();
        return true;
        
        } catch (PDOException $e) {
            // Log dell'errore
            error_log('Errore durante l\'inserimento del voto: ' . $e->getMessage());
            return $e->getMessage();  // Restituisci l'errore per feedback ulteriori
        }
    }

    public function hasUserAlreadyVoted($userId, $rankingId) {
        $stmt = $this->connect()->prepare("SELECT COUNT(*) FROM votes WHERE id_user = ? AND id_ranking = ?");
        $stmt->execute([$userId, $rankingId]);
        return $stmt->fetchColumn() > 0;
    }
    


}
