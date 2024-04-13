<?php

namespace App\DAO;

use App\Core\DB;
use App\Models\User;
use PDO;
use PDOException;

class UserDAO extends DB {
    
    public function getSingleUser($id) {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM users WHERE id_user = ?");
            $stmt->execute([$id]);
            $userDB = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($userDB) {
                return new User($userDB['id_user'], $userDB['fullname'], $userDB['email'], $userDB['username'], $userDB['image_path'], $userDB['role']);
            }
            return null;
        } catch (PDOException $e) {
            error_log("PDOException in getSingleUser: " . $e->getMessage());
            return null;
        }
    }

    public function updateSingleUser($id, $fullname, $email, $username, $user_image) {
        try {
            $stmt = $this->connect()->prepare("UPDATE users SET fullname=?, email=?, username=?, image_path=? WHERE id_user=?");
            $stmt->execute([$fullname, $email, $username, $user_image, $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("PDOException in updateSingleUser: " . $e->getMessage());
            return false;
        }
    }

    public function getAllUsers() {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM users");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDOException in getAllUsers: " . $e->getMessage());
            return [];
        }
    }
}
