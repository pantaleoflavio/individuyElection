<?php
namespace App\Models;
class Wrestler {

    public $id;
    public $name;
    public $country;
    public $categoryId;
    public $federationId;

    public function __construct($id, $name, $country, $categoryId, $federationId) {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
        $this->categoryId = $categoryId;
        $this->federationId = $federationId;
    }


    
}

?>