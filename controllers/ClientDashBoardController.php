<?php

// Déclaration de l'espace de noms "Controllers"
namespace Controllers;

// Importation des classes nécessaires depuis les espaces de noms respectifs
use Controller;
use Request;
use Models\Location;
use Middleware\Auth;
use Middleware\Session;

// Déclaration de la classe "ClientDashBoardController" qui étend la classe de base "Controller"
class ClientDashBoardController extends Controller
{
    // Méthode constructeur, appelée lors de la création d'une nouvelle instance de cette classe
    public function __construct()
    {
        // Initialisation de la session
        Session::init();
        
        // Vérification si l'utilisateur est déjà connecté
        Auth::loggedin();
        
        // Si l'utilisateur est un administrateur, il est redirigé vers le tableau de bord administrateur
        if(Auth::isAdmin()):
            $this->redirect('/admin/dashboard');
        endif;
    }
    
    // Méthode "index", qui est probablement la méthode appelée par défaut lorsque cette classe est invoquée
    public function index(): void
    {
        // Création d'une nouvelle instance de la classe "Location"
        $location = new Location();
        
        // Récupération des données des terrains les plus utilisés
        $locations = $location->mostusedLand();
        
        // Récupération du nombre de joueurs connectés
        $ConnectedPlayer = $location->ConnectedPlayer();
        
        // Récupération des statistiques des joueurs connectés
        $ConnectedPlayerStats = $location->ConnectedPlayerStats();

        // Appel de la méthode "view" pour afficher la vue du tableau de bord client, en passant les données récupérées en paramètre
        $this->view('client/dashboard', compact('locations', 'ConnectedPlayer', 'ConnectedPlayerStats'));
    }
}
