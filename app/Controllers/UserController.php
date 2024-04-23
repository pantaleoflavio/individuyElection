<?php

namespace App\Controllers;

use App\DAO\UserDAO;
use App\Models\User;

class UserController {
    
    private $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAO(); // Inizializza UserDAO
    }

    public function getSingleUser($id) {
        return $this->userDAO->getSingleUser($id);
    }

    public function updateSingleUser($id, $fullname, $email, $username, $user_image) {
        return $this->userDAO->updateSingleUser($id, $fullname, $email, $username, $user_image);
    }

    public function getAllUsers() {
        return $this->userDAO->getAllUsers();
    }
    
    public function setUserRole($id, $role) {
        return $this->userDAO->setUserRole($id, $role);
    }
}