<?php

namespace Controllers;

use Controller;
use Middleware\Auth;
use Middleware\Session;
use Models\Article;
use Request;

class ArticleController extends Controller
{

    public function __construct()
    {
        Session::init();
        Auth::loggedin();
        if(Auth::isClient()):
            $this->redirect('/client/dashboard');
          endif;
    }
    public function index(): void
    {
        $article = new Article();
        $allBlogs = $article->allBlogs();
        /* allBlogs */

        $this->view('admin/blog/all-blogs', compact('allBlogs'));
    }

    public function addBlog(): void
    {

        $article = new Article();
        $allCategory = $article->allCategory();

        $this->view('admin/blog/add-blog', compact('allCategory'));
    }

    public function EditBlog(int $id): void
    {
     
        $id = $id;

        $article = new Article();
        $allCategory = $article->allCategory();
        $blog = $article->getBlogById($id);       
        $this->view('admin/blog/edit-blog', compact('allCategory', 'id', 'blog'));
    }

    /* $this->redirect('/products/show', ['id' => $id]); */



    public function processAddBlog(): void
    {

        $article = new Article();
        $message = [];
        $smessage = '';
        $error = false;
        $data = Request::getFormData();
        $file = $_FILES['blogimage'];

        $allCategory = $article->allCategory();


        if (empty($data['blogtitle'])) {
            $message[] = "Veuillez entrer le titre !";
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


        if (empty($file['name'])) {
            $message[] = "Veuillez télécharger l'image du blog !";
            $error = true;
        }

        if (!($error)) {

            $filename = time() . '-' . basename($file["name"]);

            $targetFilePath = $_SERVER['DOCUMENT_ROOT'] . '/public/upload/' . $filename;

            try {

                $data['filename'] = $filename;

                move_uploaded_file($file["tmp_name"], $targetFilePath);

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

/* 
        */

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

  

    public function showBlog(int $id): void
    {
     
        $id = $id;
        $article = new Article();
        $blog = $article->getBlogById($id);       
        $this->view('admin/blog/show-blog', compact('blog'));
    }




}
