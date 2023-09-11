<?php

namespace Controllers;

use Controller;
use Request;
use Models\Location;
use Middleware\Auth;
use Middleware\Session;



class ClientDashBoardController extends Controller

{

    public function __construct(){


       Session::init();
       Auth::loggedin();
       if(Auth::isAdmin()):
        $this->redirect('/admin/dashboard');
      endif;
            
    
    }
    public function index(): void
    {

        $location = new Location();
        $locations = $location->mostusedLand();
        $ConnectedPlayer = $location->ConnectedPlayer();
        $ConnectedPlayerStats = $location->ConnectedPlayerStats();

        


        $this->view('client/dashboard', compact('locations', 'ConnectedPlayer', 'ConnectedPlayerStats'));
    }
}