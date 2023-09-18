<?php

// Déclaration de l'espace de noms "Controllers"
namespace Controllers;

// Importation des classes nécessaires depuis les espaces de noms respectifs
use Controller;
use Middleware\Session;
use Middleware\Auth;
use Models\Terrain;
use Models\Land;
use Request;

// Déclaration de la classe "TerrainController" qui hérite de la classe "Controller"
class TerrainController extends Controller
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
    
    // Méthode pour afficher tous les terrains disponibles
    public function index(): void
    {
        // Création d'une nouvelle instance de la classe "Terrain"
        $terrain = new Terrain();
        
        // Récupération de tous les terrains disponibles
        $allTerrain = $terrain->allTerrain();
        
        // Affichage de la vue contenant tous les terrains, en passant les données des terrains en paramètre
        $this->view('client/terrain/all-terrain', compact('allTerrain'));
    }

    // Méthode pour afficher la page de réservation de terrain
    public function reserve(int $id): void
    {
        // Affectation de l'ID du terrain à réserver à la variable $id
        $id = $id;
        
        // Affichage de la page de réservation de terrain, en passant l'ID du terrain en paramètre
        $this->view('client/terrain/reserve-terrain', compact('id'));
    }

    // Méthode pour traiter le formulaire de réservation de terrain
    public function processReserve(): void
    {
        // Création d'une nouvelle instance de la classe "Terrain"
        $terrain = new Terrain();
        
        // Initialisation des messages de succès et d'erreur
        $smessage  = '';
        $message = [];
        
        // Récupération des données du formulaire
        $data = Request::getFormData();
        
        // Tentative de mise à jour du terrain avec les données du formulaire
        if ($terrain->updateTerrain($data)) {
            // Si la mise à jour réussit, enregistrement d'un message de succès
            $smessage = 'Le terrain a été réservé avec succès !';
        } else {
            // Sinon, enregistrement d'un message d'erreur
            $message[] = "There seems to be a technical error!";
        }

        // Affichage de la page de réservation de terrain avec les messages de succès et d'erreur
        $this->view('client/terrain/reserve-terrain', compact('message', 'smessage'));
    }

    // Méthode pour afficher les locations actuelles du client
    public function clientCurrentRentals(): void
    {
        // Création d'une nouvelle instance de la classe "Land"
        $land = new Land();
        
        // Récupération des locations actuelles du client
        $currentRentals =  $land->clientRentals();
        
        // Affichage de la vue des locations actuelles du client, en passant les données des locations en paramètre
        $this->view('client/land/current-rentals', compact('currentRentals'));
    }
}
