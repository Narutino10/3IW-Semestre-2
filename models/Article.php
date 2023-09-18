<?php

namespace Models;  // Définition de l'espace de noms.

use Model;  // Importation des classes nécessaires.
use PDO;

class Article extends Model  // Déclaration de la classe Article qui hérite de Model.
{

    // Méthode pour récupérer tous les blogs et leurs catégories respectives.
    public function allBlogs()
    {
        // Exécution d'une requête SQL pour récupérer tous les blogs et leurs catégories.
        $stmt = parent::$con->query('SELECT * from blogs 
        left join  blogcat ON blogs.blogcat = blogcat.cat_id');
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retour des résultats.
        return $blogs;
    }

    // Méthode pour ajouter un nouveau blog.
    public function addBlog($data)
    {
        // Préparation et exécution d'une requête SQL pour ajouter un blog.
        $stmt = parent::$con->prepare('INSERT INTO blogs (title, blogtext, blogcat, blogimage) VALUES (?, ?, ?, ?)');
        $inserted = $stmt->execute([$data['blogtitle'], $data['blogcontent'], $data['blogcat'], $data['filename']]);

        // Retour du statut de l'opération.
        return $inserted;
    }

    // Méthode pour mettre à jour un blog existant.
    public function updateBlog($data)
    {
        // Préparation et exécution d'une requête SQL pour mettre à jour un blog.
        $sql = "UPDATE blogs SET title = ?, blogtext = ?, blogcat = ?, blogimage = ? WHERE id= ?";
        $stmt= parent::$con->prepare($sql);
        $updated = $stmt->execute([$data['blogtitle'], $data['blogcontent'], $data['blogcat'], $data['filename'], $data['blogid']]);

        // Retour du statut de l'opération.
        return $updated;
    }

    // Méthode pour récupérer les détails d'un blog spécifique par son ID.
    public function getBlogById($id)
    {
        // Préparation et exécution d'une requête SQL pour récupérer les détails d'un blog spécifique.
        $query = "SELECT * from blogs 
        left join  blogcat ON blogs.blogcat = blogcat.cat_id where blogs.id = :id ORDER BY blogs.id DESC";
        $stmt = parent::$con->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $blog = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retour des résultats.
        return $blog;
    }

    // Méthode pour ajouter une nouvelle catégorie.
    public function addCategory($data)
    {
        // Préparation et exécution d'une requête SQL pour ajouter une nouvelle catégorie.
        $stmt = parent::$con->prepare('INSERT INTO blogcat (cat_title) VALUES (?)');
        $inserted = $stmt->execute([$data['categoryname']]);

        // Retour du statut de l'opération.
        if ($inserted){
            return true;
        }
        return false;
    }

    // Méthode pour récupérer toutes les catégories.
    public function allCategory()
    {
        // Préparation et exécution d'une requête SQL pour récupérer toutes les catégories.
        $stmt = parent::$con->query('SELECT * from blogcat');
        $categoryies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retour des résultats.
        return $categoryies;
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
}
