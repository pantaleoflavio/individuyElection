<?php
namespace App\Models;
class Ranking {

    public $id;
    public $categoryName;
    public $description;
    public $status;

    public function __construct($id, $categoryName, $description, $status) {
        $this->id = $id;
        $this->categoryName = $categoryName;
        $this->description = $description;
        $this->status = $status;
    }


    
}

?>