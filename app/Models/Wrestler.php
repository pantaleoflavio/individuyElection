<?php
namespace App\Models;
class Wrestler {

    public $id;
    public $name;
    public $country;
    public $categoryId;
    public $federationId;
    public $is_active;

    public function __construct($id, $name, $country, $categoryId, $federationId, $is_active) {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
        $this->categoryId = $categoryId;
        $this->federationId = $federationId;
        $this->is_active = $is_active;
    }


    
}

?>