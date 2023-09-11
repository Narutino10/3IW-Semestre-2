<?php

namespace Controllers;

use Controller;
use Middleware\Session;
use Middleware\Auth;
use Models\Land;
use Request;

class LandController extends Controller
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

        $this->view('admin/land/add-land');
    }

    public function processAddLand(): void
    {

        $land = new Land();
        $message = [];
        $smessage = '';
        $error = false;
        $data = Request::getFormData();
        $file = $_FILES['pictures'];

        if (empty($data['landname'])) {
            $message[] = "Veuillez entrer le nom du pays !";
            $error = true;
        }

        if (empty($data['ability'])) {
            $message[] = "Veuillez entrer le nom du terrain !";
            $error = true;
        }

        if (empty($data['landtype'])) {
            $message[] = "Veuillez sélectionner le type de terrain !";
            $error = true;
        }

        if (empty($data['state'])) {
            $message[] = "Veuillez entrer l'état !";
            $error = true;
        }

        if (empty($data['address'])) {
            $message[] = "veuillez entrer l'adresse !";
            $error = true;
        }

        if (empty($file['name'])) {
            $message[] = "Veuillez télécharger l'image du terrain !";
            $error = true;
        }

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

        $this->view('admin/land/add-land', compact('message', 'smessage'));
    }

    public function currentRentals(): void
    {

        $land = new Land();
        $currentRentals =  $land->currentRentals();
        $this->view('admin/land/current-rentals', compact('currentRentals'));

    }

}
