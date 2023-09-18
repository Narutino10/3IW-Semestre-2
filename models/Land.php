<?php

namespace Models;  // Définition de l'espace de noms.

use Model;  // Importation des classes nécessaires.
use PDO;


class Land extends Model
{



    // Méthode pour ajouter un nouveau terrain.
    public function addLand($data)
    {
        // Préparation et exécution d'une requête SQL pour ajouter un terrain.
        $stmt = parent::$con->prepare('INSERT INTO terrain (nom, capacite, typeterrain, etat, images, adresse) VALUES (?, ?, ?, ?, ?, ?)');
        $inserted = $stmt->execute([$data['landname'], $data['ability'], $data['landtype'], $data['state'], $data['filename'], $data['address']]);

        // Retour du statut de l'opération.
        if ($inserted){
            return true;
        }
        return false;
    }

    // Méthode pour récupérer les locations en cours.
    public function currentRentals()
    {
        // Préparation et exécution d'une requête SQL pour récupérer les locations en cours.
        $stmt = parent::$con->query('SELECT location.id, client.nom, location.date_location, location.horaire, location.score 
    FROM location 
    JOIN client ON location.client_id = client.id');
    $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retour des résultats.
    return $locations;
    }

    // Méthode pour récupérer les locations d'un terrain spécifique par son ID.
    public function clientRentals()
    {
        // Préparation et exécution d'une requête SQL pour récupérer les locations d'un terrain spécifique par son ID.
        $stmt = parent::$con->query('SELECT location.id, client.nom, location.date_location, location.horaire, location.score, terrain.nom AS terrain_nom
        FROM location
        JOIN client ON location.client_id = client.id
        JOIN terrain ON location.terrain_id = terrain.id');
        $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retour des résultats.
        return $locations;
    }
}
