<?php
namespace App\Models;
class Ranking {
    public $id;
    public $name;
    public $description;
    public $rankingType;
    public $status;
    public $categoryId;
    public $includeInactive;

    public function __construct($id, $name, $description, $rankingType, $status, $categoryId, $includeInactive) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->rankingType = $rankingType;
        $this->status = $status;
        $this->categoryId = $categoryId;
        $this->includeInactive = $includeInactive;
    }
}


?>