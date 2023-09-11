<?php

namespace Models;

use Model;
use PDO;


class User extends Model
{

    public function login($data)  {

        $stmt = parent::$con->prepare('SELECT * FROM client WHERE mail = ? AND active = ?');
        $stmt->execute([$data['email'], 1]);
        $count = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($count  == 1) {
            if (password_verify($data['pwd'], $row['mdp'])) {
               return $row;

            }
        }

        return false;

    }

    public function register($data)  {

        $password = password_hash($data['pwd'], PASSWORD_DEFAULT);
        $stmt = parent::$con->prepare('INSERT INTO client (mail, nom, prenom, mdp, role, token, active) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $inserted = $stmt->execute([$data['email'], $data['fname'], $data['lname'], $password, $data['role'], $data['code'], $data['active']]);

        if ($inserted){
            return true;
        }
        return false;

    }

    public function checkRegisteredEmail($email){

        $query = "SELECT * FROM client WHERE mail = :email";
        $stmt = parent::$con->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;

    }

    public function activateUserAccount($token){
      
       $sql = "UPDATE client SET active = ?,  token = ? WHERE token= ?";
      $stmt= parent::$con->prepare($sql);
       if($stmt->execute([1,'', $token])){
        return true;
       }
       return false;

    }

    public function updateUserToken($data){
      
        $sql = "UPDATE client SET token = ? WHERE mail= ?";
       $stmt= parent::$con->prepare($sql);
        if($stmt->execute([$data['code'], $data['email']])){
         return true;
        }
        return false;
 
     }

    public function resetUserPassword($data){
      
        $password= password_hash($data['pwd'], PASSWORD_DEFAULT);
        $sql = "UPDATE client SET token = ?, mdp = ? WHERE token= ?";
        $stmt= parent::$con->prepare($sql);

        if($stmt->execute(['', $password, $data['token']])){
         return true;
        }
        return false;
 
     }


}