<?php

namespace Models;  // Définition de l'espace de noms.

use Model;  // Importation des classes nécessaires.


class Product extends Model
{
    // Nom de la table dans la base de données.
    protected string $table = 'products';
}