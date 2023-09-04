<?php

namespace Controllers;

use Controller;
use Middleware\Session;
use Middleware\Auth;

use Models\Stats;
use Request;

class StatsController extends Controller
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

        $this->view('admin/stats/stats');
    }

    public function getJoueurDetails(): void
    {

        $data = Request::getFormData();


        
        $stats = new Stats();

        $JoueurDetails =  $stats->getJoueurDetails($data);
        echo json_encode($JoueurDetails);
        die();
    }

}
