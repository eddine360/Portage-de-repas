<?php
class Conf {
    // la variable debug est un boolean
    static private $debug = True;

    static public function getDebug() {
        return self::$debug;
    }

    static private $databases = array(
        // Le nom d'hote est infolimon a l'IUT
        // ou localhost sur votre machine
        'hostaddr' => '10.11.159.20',
        // A l'IUT, vous avez une BDD nommee comme votre login
        // Sur votre machine, vous devrez creer une BDD
        'database' => 'Portage_de_repas_Bram',
        // A l'IUT, c'est votre login
        // Sur votre machine, vous avez surement un compte 'root'
        'login' => 'postgres',
        // A l'IUT, c'est votre mdp (INE par defaut)
        // Sur votre machine personelle, vous avez creez ce mdp a l'installation
        'password' => 'postgres'
    );

    static public function getLogin() {
        //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
        return self::$databases['login'];
    }

    static public function getHostaddr(){
        return self :: $databases['hostaddr'];
    }

    static public function getDatabase(){
        return self::$databases['database'];
    }

    static public function getPassword() {
        return self::$databases['password'];
    }
}
