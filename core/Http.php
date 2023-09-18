<?php

// Déclaration d'une classe "Http"
class Http
{
    // Méthode statique "responseCode" qui permet de définir le code de réponse HTTP. 
    // Elle accepte un paramètre entier ($code) qui représente le code de réponse HTTP à définir.
    public static function responseCode(int $code): void
    {
        // Utilisation de la fonction intégrée "http_response_code" pour définir le code de réponse HTTP.
        http_response_code($code);
    }

    // Méthode statique "getResponseCode" qui permet de récupérer le code de réponse HTTP actuel.
    // Elle ne prend aucun paramètre et renvoie un entier représentant le code de réponse HTTP actuel.
    public static function getResponseCode(): int
    {
        // Utilisation de la fonction intégrée "http_response_code" pour récupérer le code de réponse HTTP actuel.
        return http_response_code();
    }
}
