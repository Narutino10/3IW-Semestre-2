<?php

namespace Controllers;
use Config\Core as Config;
use Controller;
use Request;
use Models\User;
use Middleware\Auth;
use Middleware\Session;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class LoginRegisterController extends Controller

{


    public function __construct(){

        Session::init();
    }

    public function welcome(): void
    {


        $this->view('welcome');
    }


    public function index(): void
    {

      if(Auth::isAdmin()):
        $this->redirect('/admin/dashboard');
      endif;
      if(Auth::isClient()):
        $this->redirect('/client/dashboard');
      endif;

        $this->view('login');
    }


    public function processLogin(): void
    {

        $user = new User();
        $message =[];
        $error = false;
        $data = Request::getFormData();



        if (empty($data['email'])) {
            $message[] = "Veuillez entrer votre e-mail !";
            $error = true;
          }

        else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $message[] = "Format d'email invalide";
            $error = true;
          }
          if (empty($data['pwd'])) {
            $message[] = "Veuillez entrer le mot de passe!";
            $error = true;
        }
          
          if(!($error)){

            $user_data = $user->login($data);
            if($user_data){
                Session::put('loggedin', 'yes');
                Session::put('id', $user_data['id']);
                Session::put('role', $user_data['role']);
                Session::put('nom', $user_data['nom']);
                if($user_data['role'] == 'admin'){
                  header("Location: /admin/dashboard");
                }else{
                  header("Location: /client/dashboard");
                }
               
                exit();
            }
            else{
                $message[] = "Authentification invalide!";
                
            }
          }

          $this->view('login', compact('message'));
    }


    public function register(): void
    {
      
        if(Auth::isAdmin()):
          $this->redirect('/admin/dashboard');
        endif;
        if(Auth::isClient()):
          $this->redirect('/client/dashboard');
        endif;
       
        $this->view('register');
    }
 

    
    public function registerUser(): void
    {
      
        Auth::loggedin();
        if(Auth::isClient()):
          $this->redirect('/client/dashboard');
        endif;

        $this->view('admin/register-user');
    }



    public function processRegister(): void
    {

        $user = new User();
        $message =[];
        $smessage = '';
        $error = false;
        $data = Request::getFormData();
        if (empty($data['email'])) {
            $message[] = "Veuillez entrer votre e-mail !";
            $error = true;
          }

        else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $message[] = "Invalid email format";
            $error = true;
          }

          if (empty($data['fname'])) {
            $message[] = "Veuillez saisir votre prénom !";
            $error = true;
          }

          if (empty($data['lname'])) {
            $message[] = "Veuillez entrer votre nom de famille !";
            $error = true;
          }

          if (empty($data['pwd'])) {
            $message[] = "Veuillez entrer le mot de passe!";
            $error = true;
          }
          if($user->checkRegisteredEmail($data['email']) > 0){
            $message[] = "Cet e-mail est déjà enregistré!";
            $error = true;
          }
          
          
          if(!($error)){
            
            $token = md5($data['email']).rand(10,9999);;
            
            $activationlink = Config::APP_URL.'/account-activate?token='.$token;
            $data['active'] = $data['regvia'] == 'admin' ? 1 : 0;
            $data['code'] = $data['regvia'] == 'admin' ? '' : $token;
          
            $mail = new PHPMailer(true);
        if($user->register($data)){
          if($data['regvia'] == 'client'){
                try {   
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host       = Config::SMTP_HOST;
                    $mail->SMTPAuth   = true;
                    $mail->Username   = Config::SMTP_USERNAME;
                    $mail->Password   = Config::SMTP_PASSWORD;
                    $mail->SMTPSecure = Config::SMTP_ENCRYPT;
                    $mail->Port       = Config::SMTP_PORT;
                    $mail->setFrom(Config::SMTP_FROM, 'Support');
                    $mail->addAddress($data['email']);
                    $mail->isHTML(true);
                    $mail->Subject = 'Activez votre compte!';
                    $mail->Body    = 'Merci pour votre inscription merci d\'activer votre compte en cliquant sur le <a href="' . $activationlink . '">lien</a>';
    
                    $mail->send();
                    $smessage = 'Veuillez vérifier votre courrier électronique pour vérifier votre courrier électronique';
    
                } catch (Exception $e) {
                    $message[]= 'Il y a une erreur de messagerie:'.$mail->ErrorInfo;
                }
              }else{
                $smessage = 'Utilisateur ajouté avec succès';
              }
            } 
            else{

                $message[] = "Il semble y avoir une erreur technique !";
            }
    

           


          }

          if($data['regvia'] == 'client'){

          $this->view('register', compact('message', 'smessage'));
          }else{

            $this->view('admin/register-user', compact('message', 'smessage'));
          }
    }

 





    function activateAccount($token){

        $user = new User();

        if($user->activateUserAccount($token)){
            $message = [
                'message' => 'Votre compte a été activé avec succès !',
                'type' => 'success'
            ];
        }else{

            $message = [
                'message' => 'Il semble y avoir une erreur technique !',
                'type' => 'error'
            ];
        }

        $this->view('account-active', compact('message'));

    }


    
    function resetPassword(){   

        $this->view('reset');

    }

    public function sendEmailResetPassword(): void
    {

        $user = new User();
        $message =[];
        $smessage = '';
        $error = false;
        $data = Request::getFormData();
      
        if (empty($data['email'])) {
            $message[] = "Veuillez entrer votre e-mail !";
            $error = true;
          }

        else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $message[] = "Format d'email invalide";
            $error = true;
          }

          if(!$error ){

          if($user->checkRegisteredEmail($data['email']) == 1){

            $token = md5($data['email']).rand(10,9999);;
            
            $resetlink = Config::APP_URL.'/verify-reset-password?token='.$token;

            $data['code'] = $token;

            $user->updateUserToken($data);

            $mail = new PHPMailer(true);

            
            try {   
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host       = Config::SMTP_HOST;
                $mail->SMTPAuth   = true;
                $mail->Username   = Config::SMTP_USERNAME;
                $mail->Password   = Config::SMTP_PASSWORD;
                $mail->SMTPSecure = Config::SMTP_ENCRYPT;
                $mail->Port       = Config::SMTP_PORT;
                $mail->setFrom(Config::SMTP_FROM, 'Support');
                $mail->addAddress($data['email']);
                $mail->isHTML(true);
                $mail->Subject = 'Reset Password!';
                $mail->Body    = 'Pour réinitialiser votre mot de passe cliquez sur ce <a href="' . $resetlink . '">lien</a>';

                $mail->send();
                $smessage = 'Veuillez vérifier votre courrier électronique pour changer votre mot de passe !';

            } catch (Exception $e) {
                $message[]= 'Il y a une erreur de messagerie:'.$mail->ErrorInfo;
            }
           
          }else{

            $message[] = "Je n'ai pas trouvé cet e-mail !";
            
          }
        }

          $this->view('reset', compact('message', 'smessage'));
    }


    function verifyResetPassword($token){


        $this->view('verify-reset', compact('token'));

    }


    
    function processResetPassword(){


        $user = new User();
        $message =[];
        $smessage = '';
        $error = false;
        $data = Request::getFormData();
    
        if (empty($data['pwd'])) {
            $message[] = "Veuillez entrer le mot de passe!";
            $error = true;
          }

          if($user->resetUserPassword($data)){
            $smessage = "Votre mot de passe a été modifié avec succès !";
          }
          else{
            $message[] = "Il y a une erreur technique, veuillez réessayer plus tard !";
          }


        $this->view('verify-reset', compact('smessage', 'message'));

    }

    function logout(){

      Session::init();
      Session::destroy();
      Session::delete('loggedin');
      Session::delete('role');
      Session::delete('nom');
      
      header("Location: /");
      exit();
    }
}