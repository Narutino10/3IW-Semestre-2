<?php

// Définition de l'espace de nom des contrôleurs
namespace Controllers;

// Importation des classes nécessaires à partir d'autres espaces de nom
use Controller;
use Request;
use Models\Location;
use Middleware\Auth;
use Middleware\Session;

// Définition de la classe AdminDashBoardController qui hérite de la classe Controller
class AdminDashBoardController extends Controller

{
    // Constructeur de la classe
    public function __construct(){
      // Initialisation de la session
      Session::init();

      // Vérification si l'utilisateur est connecté
      Auth::loggedin();

      // Si l'utilisateur est un client, il sera redirigé vers le tableau de bord du client
      if(Auth::isClient()):
        $this->redirect('/client/dashboard');
      endif;
    }


    // Méthode pour afficher l'index (tableau de bord administratif)
    public function index(): void
    {        
      // Création d'une nouvelle instance de la classe Location
      $location = new Location();
      
      // Appel de diverses méthodes sur l'objet $location pour obtenir des données à passer à la vue
      $locations = $location->mostusedLand();
      $ConnectedPlayer = $location->ConnectedPlayer();
      $ConnectedPlayerStats = $location->ConnectedPlayerStats();

      // Affichage de la vue 'admin/dashboard' avec les données récupérées
      $this->view('admin/dashboard', compact('locations', 'ConnectedPlayer', 'ConnectedPlayerStats'));
    }
}