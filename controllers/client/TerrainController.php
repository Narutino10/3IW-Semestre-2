<?php

namespace Controllers\Client;

use Controller;
use Middleware\Session;
use Middleware\Auth;
use Models\Terrain;
use Models\land;
use Request;

class TerrainController extends Controller
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

        $terrain = new Terrain();
        $allTerrain = $terrain->allTerrain();

        $this->view('client/terrain/all-terrain', compact('allTerrain'));
    }

    public function reserve(int $id): void
    {

        $id = $id;


        $this->view('client/terrain/reserve-terrain', compact('id'));
    }

    public function processReserve(): void
    {

        $terrain = new Terrain();
        $smessage  = '';
        $message = [];
        $data = Request::getFormData();
        if ($terrain->updateTerrain($data)) {

            $smessage = 'Le terrain a été réservé avec succès !';
        } else {

            $message[] = "There seems to be technical error!";
        }

   

        $this->view('client/terrain/reserve-terrain', compact('message', 'smessage'));
    }


    

    public function currentRentals(): void
    {

        $land = new Land();
        $currentRentals =  $land->clientCurrentRentals();
        $this->view('client/land/current-rentals', compact('currentRentals'));

    }

}
