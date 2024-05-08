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

    public function getUserByEmail($email) {
        return $this->userDAO->getUserByEmail($email);
    }    

    public function saveResetToken($email, $token, $expiry) {
        return $this->userDAO->saveResetToken($email, $token, $expiry);
    }

    public function verifyResetToken($email, $token) {
        return $this->userDAO->verifyResetToken($email, $token);
    }

    public function updatePassword($email, $hashedPassword) {
        return $this->userDAO->updatePassword($email, $hashedPassword);
    }
}