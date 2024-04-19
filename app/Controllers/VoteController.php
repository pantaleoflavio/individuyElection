<?php

namespace App\Controllers;

use App\Models\Vote;
use App\DAO\VoteDAO;

class VoteController {
    private $voteDAO;

    public function __construct() {
        $this->voteDAO = new VoteDAO(); // Inizializza VoteDAO
    }

    public function submitVote($data) {
        // Crea un nuovo oggetto Vote dal dato fornito
        $vote = new Vote(
            $data['idRanking'] ?? null,
            $data['idWrestler'] ?? null,
            $data['idTagTeam'] ?? null,
            $data['idUser'] ?? null,
            $data['score'] ?? null,
            $data['year'] ?? null
        );

        if ($this->validateVote($vote)) {
            // Salva il voto usando VoteDAO e gestisci il risultato
            $result = $this->voteDAO->saveVote($vote);
            if ($result) {
                return "Voto salvato con successo.";
            } else {
                return "Errore nel salvataggio del voto.";
            }
        } else {
            return "Dati del voto non validi.";
        }
    }

    private function validateVote(Vote $vote) {
        // logica per validare i voti

        return isset($vote->idRanking, $vote->idUser, $vote->score, $vote->year);
    }

    // Controller method for to check if user has already voted
    public function hasUserAlreadyVoted($userId, $rankingId, $wrestlerId) {
        return $this->voteDAO->hasUserAlreadyVoted($userId, $rankingId, $wrestlerId);
    }

    public function getVoteHistoryByUserId($userId) {
        return $this->voteDAO->getVoteHistoryByUserId($userId);
    }

}
