<?php

// Déclaration de l'espace de noms "Controllers"
namespace Controllers;

// Importation des classes nécessaires depuis les espaces de noms respectifs
use Controller;
use Middleware\Session;
use Middleware\Auth;
use Models\Stats;
use Request;

// Déclaration de la classe "StatsController" qui hérite de la classe "Controller"
class StatsController extends Controller
{
    // Méthode constructeur, appelée lors de la création d'une nouvelle instance de cette classe
    public function __construct()
    {
        // Initialisation de la session
        Session::init();
        
        // Vérification si l'utilisateur est déjà connecté
        Auth::loggedin();
        
        // Si l'utilisateur est un client, il est redirigé vers le tableau de bord client
        if(Auth::isClient()):
            $this->redirect('/client/dashboard');
        endif;
    }
    
    // Méthode pour afficher les statistiques (probablement pour les administrateurs étant donné la redirection dans le constructeur)
    public function index(): void
    {
        // Affichage de la vue des statistiques pour les administrateurs
        $this->view('admin/stats/stats');
    }

    // Méthode pour obtenir les détails d'un joueur
    public function getJoueurDetails(): void
    {
        // Récupération des données du formulaire (probablement l'ID ou le nom du joueur)
        $data = Request::getFormData();

        // Création d'une nouvelle instance de la classe "Stats"
        $stats = new Stats();

        // Récupération des détails du joueur à partir du modèle "Stats"
        $JoueurDetails =  $stats->getJoueurDetails($data);

        // Envoi des détails du joueur au format JSON comme réponse
        echo json_encode($JoueurDetails);
        
        // Arrêt du script (pour éviter toute sortie supplémentaire)
        die();
    }
}
