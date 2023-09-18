<?php

namespace Models;  // Définition de l'espace de noms.

use Model;  // Importation des classes nécessaires.
use PDO;



class User extends Model
{

    // Méthode pour connecter un utilisateur.
    public function login($data)
    {
        // Préparation et exécution d'une requête SQL pour récupérer les informations de l'utilisateur.
        $stmt = parent::$con->prepare('SELECT * FROM client WHERE mail = ? AND active = ?');
        $stmt->execute([$data['email'], 1]);

        // Vérification du nombre de résultats.
        $count = $stmt->rowCount();
        if ($count !== 1) {
            return false;
        }

        // Récupération des informations de l'utilisateur.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification du mot de passe.
        if (!password_verify($data['pwd'], $row['mdp'])) {
            return false;
        }

        // Retour des informations de l'utilisateur.
        return $row;
    }

    // Méthode pour enregistrer un nouvel utilisateur.
    public function register($data)
    {
        // Hachage du mot de passe.
        $password = password_hash($data['pwd'], PASSWORD_DEFAULT);

        // Préparation et exécution d'une requête SQL pour insérer le nouvel utilisateur dans la base de données.
        $stmt = parent::$con->prepare('INSERT INTO client (mail, nom, prenom, mdp, role, token, active) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $inserted = $stmt->execute([$data['email'], $data['fname'], $data['lname'], $password, $data['role'], $data['code'], $data['active']]);

        // Vérification du statut de l'insertion.
        if ($inserted) {
            return true;
        }

        return false;
    }

    // Méthode pour vérifier si une adresse e-mail est déjà enregistrée.
    public function checkRegisteredEmail($email)
    {
        // Préparation et exécution d'une requête SQL pour compter le nombre d'utilisateurs avec l'adresse e-mail spécifiée.
        $query = "SELECT * FROM client WHERE mail = :email";
        $stmt = parent::$con->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Récupération du nombre d'utilisateurs.
        $count = $stmt->rowCount();

        // Retour du nombre d'utilisateurs.
        return $count;
    }

    // Méthode pour activer le compte d'un utilisateur.
    public function activateUserAccount($token)
    {
        // Préparation et exécution d'une requête SQL pour mettre à jour le statut du compte de l'utilisateur.
        $sql = "UPDATE client SET active = ?,  token = ? WHERE token= ?";
        $stmt= parent::$con->prepare($sql);
        if($stmt->execute([1,'', $token])){
         return true;
        }
        return false;
    }

    // Méthode pour mettre à jour le token d'un utilisateur.
    public function updateUserToken($data)
    {
        // Préparation et exécution d'une requête SQL pour mettre à jour le token de l'utilisateur.
        $sql = "UPDATE client SET token = ? WHERE mail= ?";
        $stmt= parent::$con->prepare($sql);
        if($stmt->execute([$data['code'], $data['email']])){
         return true;
        }
        return false;
    }

    // Méthode pour réinitialiser le mot de passe d'un utilisateur.
    public function resetUserPassword($data)
    {
        // Hachage du nouveau mot de passe.
        $password = password_hash($data['pwd'], PASSWORD_DEFAULT);

        // Préparation et exécution d'une requête SQL pour mettre à jour le mot de passe de l'utilisateur.
        $sql = "UPDATE client SET token = ?, mdp = ? WHERE token= ?";
        $stmt= parent::$con->prepare($sql);

        if($stmt->execute(['', $password, $data['token']])){
         return true;
        }
        return false;
    }
}
