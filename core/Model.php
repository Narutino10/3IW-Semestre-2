<?php

// Importation de la classe Config sous l'alias Config
use Config\Core as Config;

// Déclaration d'une classe abstraite Model
abstract class Model
{
    // Déclaration d'une propriété protégée pour stocker le nom de la table associée au modèle
    protected string $table;

    // Déclaration d'une propriété protégée statique pour stocker l'instance PDO (connexion à la base de données)
    protected static PDO $con;

    // Méthode constructeur qui est appelée chaque fois qu'une nouvelle instance de la classe est créée
    public function __construct()
    {
        // Si la connexion n'est pas encore établie, appelle la méthode connect pour établir la connexion
        if (empty(self::$con)) {
            self::connect();
        }
    }

    // Méthode statique pour établir une connexion à la base de données
    public static function connect()
    {
        try {
            // Tentative de création d'une nouvelle instance PDO en utilisant les paramètres de configuration
            self::$con = new PDO(
                'pgsql:host=' . Config::HOSTNAME . ';port=' . Config::PORT . ';dbname=' . Config::DBNAME,  // Chaîne DSN pour la connexion
                Config::USERNAME,  // Nom d'utilisateur pour la connexion à la base de données
                Config::PASSWORD,  // Mot de passe pour la connexion à la base de données
                Config::OPTIONS    // Options supplémentaires pour la connexion PDO
            );
        } catch (PDOException $e) {
            // Si une exception est levée (erreur de connexion), termine le script et affiche le message d'erreur
            die($e->getMessage());
        }
    }
}
