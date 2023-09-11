<?php

namespace Controllers;

use Controller;
use Request;
use Models\Location;
use Middleware\Auth;
use Middleware\Session;



class AdminDashBoardController extends Controller

{

    public function __construct(){

       Session::init();
       Auth::loggedin();
       if(Auth::isClient()):
        $this->redirect('/client/dashboard');
      endif;
            
    
    }
    public function index(): void
    {

        /* $locations = ''; */

       /*  die(Session::get('custom')); */
        $location = new Location();
        $locations = $location->mostusedLand();
        $ConnectedPlayer = $location->ConnectedPlayer();
        $ConnectedPlayerStats = $location->ConnectedPlayerStats();

        


        $this->view('admin/dashboard', compact('locations', 'ConnectedPlayer', 'ConnectedPlayerStats'));
    }
}