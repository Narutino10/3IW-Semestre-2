<?php

namespace Models;

use Model;
use PDO;


class Land extends Model
{



    public function addLand($data)  {

        $stmt = parent::$con->prepare('INSERT INTO terrain (nom, capacite, typeterrain, etat, images, adresse) VALUES (?, ?, ?, ?, ?, ?)');
        $inserted = $stmt->execute([$data['landname'], $data['ability'], $data['landtype'], $data['state'], $data['filename'], $data['address']]);

        if ($inserted){
            return true;
        }
        return false;

    }
    public function currentRentals()  {

        $stmt = parent::$con->query('SELECT location.id, client.nom, location.date_location, location.horaire, location.score 
    FROM location 
    JOIN client ON location.client_id = client.id');
    $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $locations;


    }

    public function clientRentals()  {
        $stmt = parent::$con->query('SELECT location.id, client.nom, location.date_location, location.horaire, location.score, terrain.nom AS terrain_nom
        FROM location
        JOIN client ON location.client_id = client.id
        JOIN terrain ON location.terrain_id = terrain.id');
        $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $locations;
    }


    


}