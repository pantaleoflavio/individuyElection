<?php
namespace App\Models;
class Wrestler {

    public $id;
    public $name;
    public $height;
    public $weight;
    public $continent;
    public $country;
    public $categoryId;

    public function __construct($id, $name, $height, $weight, $continent, $country, $categoryId) {
        $this->id = $id;
        $this->name = $name;
        $this->height = $height;
        $this->weight = $weight;
        $this->continent = $continent;
        $this->country = $country;
        $this->categoryId = $categoryId;
    }


    
}

?>