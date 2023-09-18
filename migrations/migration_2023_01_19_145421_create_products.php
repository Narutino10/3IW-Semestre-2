<?php

// Définition de la classe de migration pour créer une table de produits.
class migration_2023_01_19_145421_create_products extends Migration
{
    /**
     * Méthode pour créer la table des produits.
     * Elle définit la structure de la table avec les colonnes suivantes :
     * - id : une clé primaire auto-incrémentée de type entier.
     * - name : une colonne pour stocker le nom du produit, ne peut pas être null et est de type VARCHAR avec une longueur maximale de 255 caractères.
     * - created_at : une colonne pour stocker la date et l'heure de la création du produit, de type DATETIME.
     * - updated_at : une colonne pour stocker la date et l'heure de la dernière mise à jour du produit, de type DATETIME.
     */
    public function up()
    {
        $this->create('products', [
            'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR(255) NOT NULL',
            'created_at' => 'DATETIME',
            'updated_at' => 'DATETIME',
        ]);
    }

    /**
     * Méthode pour supprimer la table des produits.
     * En cas de rollback de la migration, cette méthode sera appelée pour supprimer la table des produits de la base de données.
     */
    public function down()
    {
        $this->drop('products');
    }
}
