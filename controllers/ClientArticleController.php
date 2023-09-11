<?php

namespace Controllers;

use Controller;
use Middleware\Auth;
use Middleware\Session;
use Models\Article;
use Request;

class ClientArticleController extends Controller
{

    public function __construct()
    {
        Session::init();
        Auth::loggedin();
        if(Auth::isAdmin()):
            $this->redirect('/admin/dashboard');
          endif;
    }
    public function index(): void
    {
        $article = new Article();
        $allBlogs = $article->allBlogs();
        /* allBlogs */

        $this->view('client/blog/all-blogs', compact('allBlogs'));
    }
 

    public function showBlog(int $id): void
    {
     
        $id = $id;
        $article = new Article();
        $blog = $article->getBlogById($id);       
        $this->view('client/blog/show-blog', compact('blog'));
    }




}
