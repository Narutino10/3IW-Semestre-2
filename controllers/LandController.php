<?php

// Déclaration de l'espace de noms "Controllers"
namespace Controllers;

// Importation des classes nécessaires depuis les espaces de noms respectifs
use Controller;
use Middleware\Session;
use Middleware\Auth;
use Models\Land;
use Request;

// Déclaration de la classe "LandController" qui étend la classe de base "Controller"
class LandController extends Controller
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

    // Méthode pour afficher la page d'ajout de terrain
    public function index(): void
    {
        // Appel de la méthode "view" pour afficher la vue d'ajout de terrain
        $this->view('admin/land/add-land');
    }

    // Méthode pour traiter l'ajout d'un nouveau terrain
    public function processAddLand(): void
    {
        // Création d'une nouvelle instance de la classe "Land"
        $land = new Land();
        
        // Initialisation des variables pour les messages d'erreur/succès et les données du formulaire
        $message = [];
        $smessage = '';
        $error = false;
        $data = Request::getFormData();
        $file = $_FILES['pictures'];

        // Validation des données du formulaire : vérifications pour s'assurer que toutes les données nécessaires sont présentes
        if (empty($data['landname'])) {
            $message[] = "Veuillez entrer le nom du pays !";
            $error = true;
        }

        // Validation des données du formulaire : vérifications pour s'assurer que toutes les données nécessaires sont présentes
        if (empty($data['ability'])) {
            $message[] = "Veuillez entrer le nom du terrain !";
            $error = true;
        }

        // Validation des données du formulaire : vérifications pour s'assurer que toutes les données nécessaires sont présentes
        if (empty($data['landtype'])) {
            $message[] = "Veuillez sélectionner le type de terrain !";
            $error = true;
        }

        // Validation des données du formulaire : vérifications pour s'assurer que toutes les données nécessaires sont présentes
        if (empty($data['state'])) {
            $message[] = "Veuillez entrer l'état !";
            $error = true;
        }

        // Validation des données du formulaire : vérifications pour s'assurer que toutes les données nécessaires sont présentes
        if (empty($data['address'])) {
            $message[] = "veuillez entrer l'adresse !";
            $error = true;
        }

        // Validation des données du formulaire : vérifications pour s'assurer que toutes les données nécessaires sont présentes
        if (empty($file['name'])) {
            $message[] = "Veuillez télécharger l'image du terrain !";
            $error = true;
        }

        // Si aucune erreur n'est détectée, traiter l'ajout du terrain
        if (!($error)) {

            $filename = time() . '-' . basename($file["name"]);

            $targetFilePath = $_SERVER['DOCUMENT_ROOT'].'/public/upload/' . $filename;

            try {

                $data['filename'] = $filename;

                move_uploaded_file($file["tmp_name"], $targetFilePath);

                if ($land->addLand($data)) {

                    $smessage = 'Le terrain a été ajouté avec succès !';
                } else {
    
                    $message[] = "Il semble y avoir une erreur technique !";
                }


            } catch(Exception $e) {
                $message[]  = $e->getMessage();
            }

        }

        // Affichage de la page d'ajout de terrain avec les messages d'erreur/succès
        $this->view('admin/land/add-land', compact('message', 'smessage'));
    }

    // Méthode pour afficher les locations actuelles
    public function currentRentals(): void
    {
        // Création d'une nouvelle instance de la classe "Land"
        $land = new Land();

        // Récupération des locations actuelles depuis le modèle "Land"
        $currentRentals =  $land->currentRentals();

        // Appel de la méthode "view" pour afficher la vue des locations actuelles, en passant les données récupérées en paramètre
        $this->view('admin/land/current-rentals', compact('currentRentals'));
    }

}
