<?php

// Déclaration d'une classe abstraite "Controller", qui ne peut pas être instanciée directement mais peut être héritée par d'autres classes
abstract class Controller
{
    // Méthode pour afficher une vue. Elle accepte le chemin de la vue et un tableau d'options en tant que paramètres.
    public function view(string $view, array $options = []): void
    {
        // Extraction des variables du tableau d'options, ce qui permet d'accéder aux éléments du tableau en tant que variables individuelles
        extract($options);

        // Inclusion du fichier de vue correspondant au chemin spécifié
        require __DIR__ . '/../views/' . $view . '.view.php';
    }

    // Méthode pour rediriger l'utilisateur vers une autre URL. Elle accepte l'URL de redirection et un tableau d'options en tant que paramètres.
    public function redirect(string $url, array $options = []): void
    {
        // Si le tableau d'options n'est pas vide, il est converti en une chaîne de requête et ajouté à l'URL
        if ($options) {
            // Construction de la chaîne de requête à partir du tableau d'options
            $query = '?' . http_build_query($options);

            // Envoi d'un en-tête de redirection avec l'URL et la chaîne de requête
            header('location: ' . $url . $query);

            // Arrêt du script
            exit;
        }

        // Si le tableau d'options est vide, envoi d'un en-tête de redirection avec seulement l'URL
        header('location: ' . $url);

        // Arrêt du script
        exit;
    }
}
