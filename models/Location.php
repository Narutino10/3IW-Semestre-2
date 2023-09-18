<?php

namespace Models;  // Définition de l'espace de noms.

use Model;  // Importation des classes nécessaires.
use PDO;


class Location extends Model
{

    // Méthode pour récupérer les terrains les plus utilisés.
    public function mostusedLand()
    {
        // Préparation et exécution d'une requête SQL pour récupérer les terrains les plus utilisés.
        $statement =  parent::$con->prepare("SELECT terrain.nom, COUNT(*) AS nb_locations FROM locations
        JOIN terrain ON locations.terrain_id = terrain.id
        GROUP BY terrain.nom
        ORDER BY nb_locations DESC
        LIMIT 5");
        $statement->execute();

        // Retour des résultats.
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer les statistiques du joueur connecté.
    public function ConnectedPlayerStats($joueurId)
    {
        // Préparation et exécution d'une requête SQL pour récupérer les statistiques du joueur connecté.
        $statement =  parent::$con->prepare('SELECT COUNT(*) AS total_locations FROM locations WHERE joueur_id = :joueur_id');
        $statement->bindParam(':joueur_id', $joueurId); // Remplacez $joueurId par l'identifiant du joueur connecté
        $statement->execute();

        // Retour des résultats.
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer la prochaine location du joueur connecté.
    public function ConnectedPlayer($joueurId)
    {
        // Préparation et exécution d'une requête SQL pour récupérer la prochaine location du joueur connecté.
        $statement = parent::$con->prepare('SELECT MIN(date_location) AS prochaine_location FROM locations WHERE joueur_id = :joueur_id');
        $statement->bindParam(':joueur_id', $joueurId); // Remplacez $joueurId par l'identifiant du joueur connecté
        $statement->execute();

        // Retour des résultats.
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
