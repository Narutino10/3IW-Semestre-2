<?php
// Définition de l'espace de noms pour la classe Auth
namespace Middleware;

// Importation de la classe Session
use Middleware\Session;

// Définition de la classe Auth
class Auth {

    // Méthode pour vérifier si l'utilisateur est connecté
    public static function loggedin(){
        // Si la session 'loggedin' n'est pas égale à 'yes', redirige vers la page d'accueil
        if (Session::get('loggedin') != 'yes'){
           header("Location: /");
           exit();
        }
    }

    // Méthode pour vérifier si l'utilisateur est un administrateur
    public static function isAdmin() {
        // Si le rôle de la session est 'admin', retourne vrai
        if(Session::get('role') == 'admin' ){
           return true;
        }
        // Sinon, retourne faux
        return false;
    }

    // Méthode pour vérifier si l'utilisateur est un client
    public static function isClient() {
        // Si le rôle de la session est 'client', retourne vrai
        if(Session::get('role') == 'client' ){
           return true;
        }
        // Sinon, retourne faux
        return false;
    }

    // Méthode pour vérifier et rediriger si l'utilisateur n'est pas un administrateur
    public static function checkAdmin() {
        // Si le rôle de la session n'est pas 'admin', redirige vers le tableau de bord du client
        if(!Session::get('role') == 'admin' ){
            header("Location: /client/dashboard");
            exit();
        }
    }

    // Méthode pour vérifier et rediriger si l'utilisateur n'est pas un client
    public static function checkClient() {
        // Si le rôle de la session n'est pas 'client', redirige vers le tableau de bord de l'administrateur
        if(!Session::get('role') == 'client' ){
            header("Location: /admin/dashboard");
            exit();
        }
    }
}
