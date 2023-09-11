<?php

namespace Models;

use Model;
use PDO;


class Stats extends Model
{



    public function getJoueurDetails($data)  {


        $stmt = parent::$con->prepare('SELECT client.id, client.nom, client.images, stat.matchjouer, stat.matchgagner, stat.but, stat.passedecisive 
        FROM client 
        JOIN stat ON client.id = stat.id
        WHERE client.id = :id');
        $stmt->execute([':id' => $data['id']]);
        $joueur = $stmt->fetch(PDO::FETCH_ASSOC);

        return $joueur;

    }


    public function getClientStats() {

        $stmt = parent::$con->query('SELECT client.id, client.nom, client.images, stat.matchjouer, stat.matchgagner, stat.but, stat.passedecisive 
        FROM client 
        JOIN stat ON client.id = stat.id order by stat.but DESC');
        $joueurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $joueurs;

    }

}