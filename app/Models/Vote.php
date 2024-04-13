<?php
namespace App\Models;

class Vote {

    public $idRanking;
    public $idWrestler;
    public $idTagTeam;
    public $idUser;
    public $score;
    public $year;

    public function __construct($idRanking, $idWrestler, $idTagTeam, $idUser, $score, $year) {
        $this->idRanking = $idRanking;
        $this->idWrestler = $idWrestler;
        $this->idTagTeam = $idTagTeam;
        $this->idUser = $idUser;
        $this->score = $score;
        $this->year = $year;

    }


    
}

?>