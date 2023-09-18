<?php

namespace Models;  // Définition de l'espace de noms.

use Model;  // Importation des classes nécessaires.
use PDO;


class Terrain extends Model
{



    // Méthode pour récupérer tous les terrains.
    public function allTerrain()
    {
        // Préparation et exécution d'une requête SQL pour récupérer tous les terrains.
        $stmt = parent::$con->query('SELECT * from terrain');
        $terrains = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retour des résultats.
        return $terrains;
    }

    // Méthode pour mettre à jour l'état d'un terrain.
    public function updateTerrain($data)
    {
        // Préparation et exécution d'une requête SQL pour mettre à jour l'état d'un terrain.
        $updateStmt =  parent::$con->prepare('UPDATE terrain SET location = \'occupé\' WHERE id = :id');
        $updateStmt->bindParam(':id', $data['id']);
        if($updateStmt->execute()){
            return true;
        }

        return false;
    }


    

    


}
