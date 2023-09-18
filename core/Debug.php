<?php

// Déclaration d'une classe "Debug"
class Debug
{
    // Déclaration d'une méthode publique statique "dumpData" qui accepte deux paramètres : 
    // $data (les données à afficher) et $exit (un booléen indiquant si le script doit être arrêté après l'affichage des données)
    public static function dumpData($data, bool $exit = true): void
    {
        // Affichage d'une balise <pre> pour formater correctement les données affichées
        echo '<pre>';

        // Utilisation de la fonction var_dump pour afficher les détails des données fournies
        var_dump($data);

        // Fermeture de la balise <pre>
        echo '</pre>';

        // Si le paramètre $exit est vrai (ce qui est le cas par défaut), le script est arrêté
        if ($exit) {
            exit;
        }
    }
}
