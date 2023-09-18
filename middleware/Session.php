<?php

namespace Middleware;

class Session {

    /**
     * Supprime la valeur d'une clé spécifique de la session.
     *
     * @param string $key La clé de la session à supprimer.
     * @return boolean Retourne vrai si la clé existe et est supprimée, faux sinon.
     */
    public static function delete($key) {
        if (self::exists($key)) {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }

    /**
     * Supprime la session.
     *
     * @return void
     */
    public static function destroy() {
        session_destroy();
    }

    /**
     * Vérifie si une clé spécifique de la session existe.
     *
     * @param string $key La clé de la session à vérifier.
     * @return boolean Retourne vrai si la clé existe, faux sinon.
     */
    public static function exists($key) {
        return(isset($_SESSION[$key]));
    }

    /**
     * Retourne la valeur d'une clé spécifique de la session si elle existe.
     *
     * @param string $key La clé de la session dont la valeur doit être récupérée.
     * @return string|null Retourne la valeur de la clé si elle existe, null sinon.
     */
    public static function get($key) {
        if (self::exists($key)) {
            return($_SESSION[$key]);
        }
    }

    /**
     * Démarre la session.
     *
     * @return void
     */
    public static function init() {
        // Si aucune session n'existe, démarrez la session.
        if (session_id() == "") {
            session_start();
        }
    }

    /**
     * Définit une valeur spécifique pour une clé spécifique de la session.
     *
     * @param string $key La clé de la session à définir.
     * @param string $value La valeur à définir pour la clé de la session.
     * @return string Retourne la valeur qui a été définie.
     */
    public static function put($key, $value) {
        return($_SESSION[$key] = $value);
    }

}
