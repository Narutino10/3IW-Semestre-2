<?php

namespace Models;

use Model;
use PDO;


class Location extends Model
{

    public function mostusedLand()  {
        
        $statement =  parent::$con->prepare("SELECT terrain.nom, COUNT(*) AS nb_locations FROM locations
        JOIN terrain ON locations.terrain_id = terrain.id
        GROUP BY terrain.nom
        ORDER BY nb_locations DESC
        LIMIT 5");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    public function ConnectedPlayerStats()  {
        
        $statement =  parent::$con->prepare('SELECT COUNT(*) AS total_locations FROM locations WHERE joueur_id = :joueur_id');
        $statement->bindParam(':joueur_id', $joueurId); // Remplacez $joueurId par l'identifiant du joueur connecté
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function ConnectedPlayer()  {
        
        $statement = parent::$con->prepare('SELECT MIN(date_location) AS prochaine_location FROM locations WHERE joueur_id = :joueur_id');
        $statement->bindParam(':joueur_id', $joueurId); // Remplacez $joueurId par l'identifiant du joueur connecté
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }



  


}