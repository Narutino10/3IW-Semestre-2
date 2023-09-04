<?php

namespace Controllers\Client;

use Controller;
use Middleware\Session;
use Middleware\Auth;

use Models\Stats;
use Request;

class ClientStatsController extends Controller
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


        $stats = new Stats();
        $username = Session::get('nom');

        $getClientStats =  $stats->getClientStats();

    $this->view('client/stats/stats', compact('getClientStats', 'username'));


    }

}
