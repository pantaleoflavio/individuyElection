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

    public function setUserRole($id, $role) {
        try {
            $stmt = $this->connect()->prepare("UPDATE users SET role = ? WHERE id_user = ?");
            $stmt->execute([$role, $id]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("PDOException in setUserRole: " . $e->getMessage());
            return false;
        }
    }

    public function getUserByEmail($email) {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $userDB = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($userDB) {
                return new User($userDB['id_user'], $userDB['fullname'], $userDB['email'], $userDB['username'], $userDB['image_path'], $userDB['role']);
            }
            return null;
        } catch (PDOException $e) {
            error_log("PDOException in getUserByEmail: " . $e->getMessage());
            return null;
        }
    }

    public function saveResetToken($email, $token, $expiry) {
        try {
            $sql = "UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$token, $expiry, $email]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("PDOException in saveResetToken: " . $e->getMessage());
            return false;
        }
    }

    public function verifyResetToken($email, $token) {
        try {
            $sql = "SELECT id_user FROM users WHERE email = ? AND reset_token = ? AND token_expiry > NOW()";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email, $token]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("PDOException in verifyResetToken: " . $e->getMessage());
            return false;
        }
    }    

    public function updatePassword($email, $hashedPassword) {
        try {
            $sql = "UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE email = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$hashedPassword, $email]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("PDOException in updatePassword: " . $e->getMessage());
            return false;
        }
    }
    
}
