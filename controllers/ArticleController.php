<?php

// Définition de l'espace de noms des contrôleurs
namespace Controllers;

// Importation des classes nécessaires à partir d'autres espaces de noms
use Controller;
use Middleware\Auth;
use Middleware\Session;
use Models\Article;
use Request;

// Définition de la classe ArticleController qui hérite de la classe Controller
class ArticleController extends Controller
{
    // Constructeur de la classe
    public function __construct()
    {
        // Initialisation de la session
        Session::init();
        
        // Vérification si l'utilisateur est connecté
        Auth::loggedin();
        
        // Si l'utilisateur est un client, il sera redirigé vers le tableau de bord du client
        if(Auth::isClient()):
            $this->redirect('/client/dashboard');
        endif;
    }
    
    // Méthode pour afficher la liste des blogs
    public function index(): void
    {
        // Création d'une nouvelle instance de la classe Article
        $article = new Article();
        
        // Récupération de la liste de tous les blogs
        $allBlogs = $article->allBlogs();

        // Affichage de la vue avec la liste des blogs
        $this->view('admin/blog/all-blogs', compact('allBlogs'));
    }

    // Méthode pour afficher la page d'ajout de blog
    public function addBlog(): void
    {
        // Création d'une nouvelle instance de la classe Article
        $article = new Article();
        
        // Récupération de la liste de toutes les catégories
        $allCategory = $article->allCategory();

        // Affichage de la page d'ajout de blog avec la liste des catégories
        $this->view('admin/blog/add-blog', compact('allCategory'));
    }

    // Méthode pour afficher la page d'édition de blog
    public function EditBlog(int $id): void
    {
        // Assignation de l'ID du blog à éditer
        $id = $id;

        // Création d'une nouvelle instance de la classe Article
        $article = new Article();
        
        // Récupération de la liste de toutes les catégories
        $allCategory = $article->allCategory();
        
        // Récupération des détails du blog par ID
        $blog = $article->getBlogById($id);       

        // Affichage de la page d'édition de blog avec les détails du blog et la liste des catégories
        $this->view('admin/blog/edit-blog', compact('allCategory', 'id', 'blog'));
    }

    // Méthode pour traiter l'ajout d'un nouveau blog
    public function processAddBlog(): void
    {
        // Création d'une nouvelle instance de la classe Article et initialisation des variables pour les messages et les erreurs
        $article = new Article();
        $message = [];
        $smessage = '';
        $error = false;

        // Récupération des données du formulaire et du fichier image
        $data = Request::getFormData();
        $file = $_FILES['blogimage'];

        // Récupération de la liste de toutes les catégories
        $allCategory = $article->allCategory();

        // Validation des données du formulaire : vérification que le titre du blog est présent
        if (empty($data['blogtitle'])) {
            $message[] = "Veuillez entrer le titre !";
            $error = true;
        }

        // Validation des données du formulaire : vérification que le contenu du blog est présent
        if (empty($data['blogcontent'])) {
            $message[] = "Veuillez saisir le contenu du blog !";
            $error = true;
        }

        // Validation des données du formulaire : vérification que la catégorie du blog est sélectionnée
        if (empty($data['blogcat'])) {
            $message[] = "Veuillez sélectionner la catégorie du blog !";
            $error = true;
        }

        // Validation des données du formulaire : vérification que l'image du blog est téléchargée
        if (empty($file['name'])) {
            $message[] = "Veuillez télécharger l'image du blog !";
            $error = true;
        }

        // Si aucune erreur n'est détectée, traiter l'ajout du blog
        if (!($error)) {

            $filename = time() . '-' . basename($file["name"]);

            $targetFilePath = $_SERVER['DOCUMENT_ROOT'] . '/public/upload/' . $filename;

          /*   echo $targetFilePath; */

            try {

                $data['filename'] = $filename;

                if(!move_uploaded_file($file["tmp_name"], $targetFilePath)){
                   /*  echo 'failed'; */
                }

                if ($article->addBlog($data)) {

                    $smessage = 'Le blog a été ajouté avec succès !';
                } else {

                    $message[] = "Il semble y avoir une erreur technique !";
                }

            } catch (Exception $e) {
                $message[] = $e->getMessage();
            }

        }

        $this->view('admin/blog/add-blog', compact('message', 'smessage', 'allCategory'));
    }


    
    public function processEditBlog(): void
    {

        $article = new Article();
        $message = [];
        $smessage = '';
        $error = false;
        $data = Request::getFormData();
        $file = $_FILES['blogimage'];
        $blog = $article->getBlogById($data['blogid']);   
        $allCategory = $article->allCategory();
        

        if (empty($data['blogtitle'])) {
            $message[] = "Veuillez entrer le titre!";
            $error = true;
        }


        if (empty($data['blogcontent'])) {
            $message[] = "Veuillez saisir le contenu du blog !";
            $error = true;
        }

        if (empty($data['blogcat'])) {
            $message[] = "Veuillez sélectionner la catégorie du blog !";
            $error = true;
        }

        if (!($error)) {

            

            if (!empty($file['name'])) {
                $filename = time() . '-' . basename($file["name"]);
                $data['filename'] = $filename;
                $targetFilePath = $_SERVER['DOCUMENT_ROOT'] . '/public/upload/' . $filename;


                move_uploaded_file($file["tmp_name"], $targetFilePath);

                
            }
            else{
                $data['filename'] = $blog['blogimage'];
            } 

            if ($article->updateBlog($data)) {

                $smessage = 'Le blog a été mis à jour avec succès !';
            } else {

                $message[] = "Il semble y avoir une erreur technique !";
            }


        }

        $blog = $article->getBlogById($data['blogid']);       

        $id = $blog['id'];

        $this->view('admin/blog/edit-blog', compact('message', 'smessage','allCategory', 'id', 'blog'));

    }



    public function addCategory(): void
    {

       

        $this->view('admin/blog/category/add-category');
    }

    public function processAddCategory(): void
    {

        $article = new Article();
        $message = [];
        $smessage = '';
        $error = false;
        $data = Request::getFormData();

        if (empty($data['categoryname'])) {
            $message[] = "Veuillez entrer le nom de la catégorie !";
            $error = true;
        }

        if (!($error)) {

            if ($article->addCategory($data)) {

                $smessage = 'La catégorie a été ajoutée avec succès !';
            } else {

                $message[] = "Il semble y avoir une erreur technique !";
            }

        }

        $this->view('admin/blog/category/add-category', compact('message', 'smessage'));
    }

  

    // Méthode pour afficher un blog spécifique
    public function showBlog(int $id): void
    {
        // Assignation de l'ID du blog à afficher
        $id = $id;

        // Création d'une nouvelle instance de la classe Article
        $article = new Article();
        
        // Récupération des détails du blog par ID
        $blog = $article->getBlogById($id);       

        // Affichage de la page de visualisation de blog avec les détails du blog
        $this->view('admin/blog/show-blog', compact('blog'));
    }



}
