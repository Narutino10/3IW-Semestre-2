<?php

// Déclaration de l'espace de noms "Controllers"
namespace Controllers;

// Importation des classes nécessaires depuis les espaces de noms respectifs
use Controller;
use Middleware\Session;
use Middleware\Auth;
use Models\Stats;
use Request;

// Déclaration de la classe "ClientStatsController" qui étend la classe de base "Controller"
class ClientStatsController extends Controller
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
        // Création d'une nouvelle instance de la classe "Stats"
        $stats = new Stats();
        
        // Récupération du nom d'utilisateur depuis la session
        $username = Session::get('nom');

        // Récupération des statistiques du client depuis le modèle "Stats"
        $getClientStats =  $stats->getClientStats();

        // Appel de la méthode "view" pour afficher la vue des statistiques du client, 
        // en passant les statistiques et le nom d'utilisateur en paramètre
        $this->view('client/stats/stats', compact('getClientStats', 'username'));
    }
}
