<?php

// Définition de l'espace de noms des contrôleurs
namespace Controllers;

// Importation des classes nécessaires à partir d'autres espaces de noms
use Controller;
use Middleware\Auth;
use Middleware\Session;
use Models\Article;
use Request;

// Définition de la classe ClientArticleController qui hérite de la classe Controller
class ClientArticleController extends Controller
{
    // Constructeur de la classe
    public function __construct()
    {
        // Initialisation de la session
        Session::init();
        
        // Vérification si l'utilisateur est connecté
        Auth::loggedin();
        
        // Si l'utilisateur est un administrateur, il sera redirigé vers le tableau de bord administrateur
        if(Auth::isAdmin()):
            $this->redirect('/admin/dashboard');
        endif;
    }
    
    // Méthode pour afficher la liste des blogs pour les clients
    public function index(): void
    {
        // Création d'une nouvelle instance de la classe Article
        $article = new Article();
        
        // Récupération de la liste de tous les blogs
        $allBlogs = $article->allBlogs();

        // Affichage de la vue avec la liste des blogs (vue côté client)
        $this->view('client/blog/all-blogs', compact('allBlogs'));
    }

    // Méthode pour afficher un blog spécifique pour les clients
    public function showBlog(int $id): void
    {
        // Assignation de l'ID du blog à afficher
        $id = $id;

        // Création d'une nouvelle instance de la classe Article
        $article = new Article();
        
        // Récupération des détails du blog par ID
        $blog = $article->getBlogById($id);       

        // Affichage de la page de visualisation de blog avec les détails du blog (vue côté client)
        $this->view('client/blog/show-blog', compact('blog'));
    }
}
