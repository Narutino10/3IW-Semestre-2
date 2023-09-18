<?php

// Déclaration de la classe Router en tant que classe finale (ne peut pas être héritée)
final class Router
{
    // Déclaration d'une propriété statique privée pour stocker les routes
    private static array $routes = [];

    // Méthode statique pour ajouter une route GET à la liste des routes
    public static function get(string $uri, $controller): void
    {
        // Fusionne la route actuelle avec la liste existante des routes avec la méthode GET
        self::$routes = array_merge(self::$routes, [$uri => ['controller'=>$controller, 'type'=>'GET']]);
    }

    // Méthode statique pour ajouter une route POST à la liste des routes
    public static function post(string $uri, $controller): void
    {
        // Fusionne la route actuelle avec la liste existante des routes avec la méthode POST
        self::$routes = array_merge(self::$routes, [$uri => ['controller'=>$controller, 'type'=>'POST']]);
    }

    // Méthode statique pour ajouter une route PUT à la liste des routes
    public static function put(string $uri, $controller): void
    {
        // Fusionne la route actuelle avec la liste existante des routes avec la méthode PUT
        self::$routes = array_merge(self::$routes, [$uri => ['controller'=>$controller, 'type'=>'PUT']]);
    }

    // Méthode statique pour ajouter une route PATCH à la liste des routes
    public static function patch(string $uri, $controller): void
    {
        // Fusionne la route actuelle avec la liste existante des routes avec la méthode PATCH
        self::$routes = array_merge(self::$routes, [$uri => ['controller'=>$controller, 'type'=>'PATCH']]);
    }

    // Méthode statique pour ajouter une route DELETE à la liste des routes
    public static function delete(string $uri, $controller): void
    {
        // Fusionne la route actuelle avec la liste existante des routes avec la méthode DELETE
        self::$routes = array_merge(self::$routes, [$uri => ['controller'=>$controller, 'type'=>'DELETE']]);
    }

    // Méthode statique pour récupérer toutes les routes enregistrées
    public static function routeAll(): array
    {
        // Retourne la liste de toutes les routes enregistrées
        return self::$routes;
    }

    // Méthode statique pour vérifier si l'URI de la requête actuelle correspond à une route spécifique
    public static function currentRoute(string $route): bool
    {
        // Compare l'URI de la requête actuelle avec la route spécifiée et retourne vrai si elles correspondent
        return Request::getRequestUrl() == $route;
    }
}
