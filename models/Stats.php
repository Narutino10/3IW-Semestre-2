<?php

namespace Models;  // Définition de l'espace de noms.

use Model;  // Importation des classes nécessaires.
use PDO;


class Stats extends Model
{



    // Méthode pour récupérer les détails d'un joueur spécifique par son ID.
    public function getJoueurDetails($data)
    {

        // Préparation et exécution d'une requête SQL pour récupérer les détails d'un joueur spécifique.
        $stmt = parent::$con->prepare('SELECT client.id, client.nom, client.images, stat.matchjouer, stat.matchgagner, stat.but, stat.passedecisive 
        FROM client 
        JOIN stat ON client.id = stat.id
        WHERE client.id = :id');
        $stmt->execute([':id' => $data['id']]);
        $joueur = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retour des résultats.
        return $joueur;

    }


    // Méthode pour récupérer les statistiques de tous les joueurs, ordonnées par nombre de buts marqués en ordre décroissant.
    public function getClientStats()
    {

        // Préparation et exécution d'une requête SQL pour récupérer les statistiques de tous les joueurs, ordonnées par nombre de buts marqués en ordre décroissant.
        $stmt = parent::$con->query('SELECT client.id, client.nom, client.images, stat.matchjouer, stat.matchgagner, stat.but, stat.passedecisive 
        FROM client 
        JOIN stat ON client.id = stat.id order by stat.but DESC');
        $joueurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retour des résultats.
        return $joueurs;

    }

}
