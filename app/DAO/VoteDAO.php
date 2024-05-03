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

    public function hasUserAlreadyVoted($userId, $rankingId, $wrestlerId, $tagTeamId, $federationId) {
        $stmt = null;
        if (!is_null($wrestlerId)) {
            $stmt = $this->connect()->prepare("SELECT COUNT(*) FROM votes WHERE id_user = ? AND id_ranking = ? AND id_wrestler = ?");
            $stmt->execute([$userId, $rankingId, $wrestlerId]);
        } elseif (!is_null($tagTeamId)) {
            $stmt = $this->connect()->prepare("SELECT COUNT(*) FROM votes WHERE id_user = ? AND id_ranking = ? AND id_tag_team = ?");
            $stmt->execute([$userId, $rankingId, $tagTeamId]);
        } elseif (!is_null($federationId)) {
            $stmt = $this->connect()->prepare("SELECT COUNT(*) FROM votes WHERE id_user = ? AND id_ranking = ? AND id_federation = ?");
            $stmt->execute([$userId, $rankingId, $federationId]);
        }
    
        return $stmt->fetchColumn() > 0;
    }
    
    
    public function getVoteHistoryByUserId($userId) {
        try {
            $sql = "SELECT v.score, v.year,
                            w.name AS wrestler_name,
                            f.name AS federation_name,
                            t.name AS tag_team_name,
                            r.ranking_name,
                            v.created_at
                    FROM votes v
                    LEFT JOIN wrestlers w ON v.id_wrestler = w.id_wrestler
                    LEFT JOIN federations f ON v.id_federation = f.id_federation
                    LEFT JOIN tag_teams t ON v.id_tag_team = t.id_tag_team
                    LEFT JOIN list_ranking r ON v.id_ranking = r.id_ranking
                    WHERE v.id_user = ?
                    ORDER BY v.created_at DESC";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDOException in getVoteHistoryByUserId: " . $e->getMessage());
            return [];
        }
    }
    


}
