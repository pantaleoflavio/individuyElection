<?php
namespace App\Models;
class Ranking {

    public $id;
    public $categoryName;


    public function __construct($id, $categoryName) {
        $this->id = $id;
        $this->categoryName = $categoryName;
    }


    
}

?>