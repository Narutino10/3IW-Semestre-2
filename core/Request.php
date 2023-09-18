<?php

// Déclaration de la classe Request
class Request
{
    // Méthode statique pour obtenir l'URL de la requête en cours sans les paramètres de requête
    public static function getRequestUrl(): string
    {
        // Retourne le premier élément du tableau résultant de l'explosion de l'URL filtrée (après avoir retiré les caractères en excès des deux côtés) par le caractère "?"
        return explode("?", filter_var(trim($_SERVER['REQUEST_URI'], "/"), FILTER_SANITIZE_URL))[0];
    }

    // Méthode statique pour obtenir la méthode de la requête en cours (GET, POST, etc.)
    public static function getRequestMethod(): string
    {
        // Retourne la méthode de la requête HTTP en cours
        return $_SERVER['REQUEST_METHOD'];
    }

    // Méthode statique pour obtenir l'URL complète de la requête en cours
    public static function getFullUrl(): string
    {
        // Construit et retourne l'URL complète de la requête en cours
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    // Méthode statique pour obtenir les paramètres de l'URL de la requête en cours
    public static function getParams(): array
    {
        // Obtient l'URL complète, analyse les composants de l'URL pour obtenir la chaîne de requête, puis parse cette chaîne en un tableau associatif et le retourne
        $url = self::getFullUrl();
        $components = parse_url($url, PHP_URL_QUERY);
        parse_str($components ?? '', $results);
        return $results;
    }

    // Méthode statique pour envoyer une requête HTTP à une URL spécifiée avec des données optionnelles et une méthode de requête personnalisée
    public static function sendRequest(string $url, array $data = [], string $customRequest = 'get')
    {
        // Initialisation d'une nouvelle session cURL, configuration des options de cURL et exécution de la requête cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $customRequest);
        $result = curl_exec($ch);
        if (curl_error($ch)) {
            // En cas d'erreur cURL, affiche l'erreur et termine le script
            var_dump(curl_error($ch));
            exit;
        }
        // Retourne le résultat de la requête cURL
        return $result;
    }

    // Méthode statique pour obtenir les données POST de la requête en cours
    public static function getPost(): array
    {
        // Retourne le tableau $_POST
        return $_POST;
    }

    // Méthode statique pour obtenir les données du formulaire à partir de la requête en cours après avoir nettoyé l'entrée
    public static function getFormData(): array
    {
        // Supprime l'élément '_method' du tableau $_POST
        unset($_POST['_method']);
        
        // Nettoie les données d'entrée en utilisant la méthode sanitizeInput et retourne le résultat
        $sendPost = self::sanitizeInput($_POST);
        return $sendPost;
    }

    // Méthode statique pour nettoyer les données d'entrée
    public static function sanitizeInput($input): array
    {
        // Initialise un tableau vide pour stocker les données d'entrée nettoyées
        $returninput = [];
        // Parcourt chaque élément du tableau d'entrée
        foreach ($input as $key => $value) {
            // Nettoie chaque valeur en utilisant filter_input et stocke le résultat dans le tableau returninput
            $returninput[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        // Retourne le tableau des données d'entrée nettoyées
        return $returninput;
    }
}
