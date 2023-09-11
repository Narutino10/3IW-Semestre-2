<?php
namespace Middleware;

use Middleware\Session;

class Auth {


    public static function loggedin(){
        if (Session::get('loggedin') != 'yes'){
           header("Location: /");
           exit();
        }
    }

    public static function isAdmin() {
        if(Session::get('role') == 'admin' ){
           return true;
        }
        return false;

    }
    public static function isClient() {
        if(Session::get('role') == 'client' ){
           return true;
        }
        return false;
        
    }

    public static function checkAdmin() {
        if(!Session::get('role') == 'admin' ){
            header("Location: /client/dashboard");
            exit();
        }
    }

    public static function checkClient() {
        if(!Session::get('role') == 'client' ){
            header("Location: /admin/dashboard");
            exit();
        }
    }

}