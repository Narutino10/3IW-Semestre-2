<?php

// Déclaration de la classe finale "App", qui ne peut pas être héritée par d'autres classes
final class App
{
    // Déclaration d'une propriété privée "$debug" qui stocke un booléen indiquant si le mode de débogage est activé ou non
    private bool $debug = true;

    // Déclaration de la méthode "run" qui ne retourne rien (void)
    public function run(): void
    {
        // Initialisation de la session (commentée dans ce script)
        /*  Session::init(); */

        // Récupération de toutes les routes définies dans l'application
        $routes = Router::routeAll();

        // Récupération de l'URL de la requête actuelle
        $request = Request::getRequestUrl();

        // Vérification si l'URL de la requête est présente dans les routes définies
        if (array_key_exists($request, $routes)) {
            // Récupération de la route correspondante
            $route = $routes[$request];

            // Vérification si la méthode de la requête correspond à celle définie dans la route
            if ($route['type'] == Request::getRequestMethod() or (isset(Request::getPost()['_method']) and $route['type'] == Request::getPost()['_method'] and Request::getRequestMethod() == "POST")) {
                // Récupération du contrôleur de la route
                $route = $route['controller'];

                try {
                    // Si le contrôleur est un tableau, il contient le nom de la classe et le nom de la méthode
                    if (is_array($route)) {
                        $controllerName = $route[0];
                        $function = $route[1];
                        $controller = new $controllerName();
                        call_user_func_array([$controller, $function], Request::getParams());
                    } else {
                        // Si le contrôleur n'est pas un tableau, il contient juste le nom de la classe
                        $controllerName = $route;
                        $controller = new $controllerName();
                        call_user_func_array($controller, Request::getParams());
                    }
                    // Envoi d'une réponse HTTP avec le code 200 (OK)
                    Http::responseCode(200);
                } catch (Error $e) {
                    // Gestion des erreurs, par exemple si des arguments sont manquants pour la fonction appelée
                    if (mb_stripos($e->getMessage(), 'Too few arguments to function') !== false) {
                        $error = 'Missing required parameters';
                        require __DIR__ . '/../views/error.view.php';
                        Http::responseCode(422);
                    }
                }
            } else {
                // Si la méthode de la requête n'est pas autorisée, envoi d'une erreur 405
                $error = '405 method not allowed';
                require __DIR__ . '/../views/error.view.php';
                Http::responseCode(405);
            }
        } else {
            // Si l'URL de la requête n'est pas trouvée, envoi d'une erreur 404
            $error = '404 not found';
            require __DIR__ . '/../views/error.view.php';
            Http::responseCode(404);
        }

        // Activation ou désactivation de l'affichage des erreurs en fonction de la valeur de la propriété "$debug"
        if ($this->debug) {
            ini_set('display_errors', 1);
        } else {
            ini_set('display_errors', 0);
        }
    }

    // Méthode pour activer ou désactiver le mode de débogage
    public function debug(bool $action): void
    {
        $this->debug = $action;
    }

    // Méthode pour activer le rapport d'erreur PHP si le mode de débogage est activé
    public function error_reporting(): void
    {
        if ($this->debug) {
            error_reporting(E_ALL);
        }
    }
}
