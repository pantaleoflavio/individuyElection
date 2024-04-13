<?php
namespace App\Models;
class Ranking {

    public $idRanking;
    public $rankingName;
    public $description;
    public $status;
    public $category_id;

    public function __construct($idRanking, $rankingName, $description, $status, $category_id) {
        $this->idRanking = $idRanking;
        $this->rankingName = $rankingName;
        $this->description = $description;
        $this->status = $status;
        $this->category_id = $category_id;
    }


    
}

?>