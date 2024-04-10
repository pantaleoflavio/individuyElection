<?php
namespace App\Models;
class Wrestler {

    public $id;
    public $name;
    public $height;
    public $weight;
    public $continent;
    public $country;

    public function __construct($id, $name, $height, $weight, $continent, $country) {
        $this->id = $id;
        $this->name = $name;
        $this->height = $height;
        $this->weight = $weight;
        $this->continent = $continent;
        $this->country = $country;
    }


    
}

?>