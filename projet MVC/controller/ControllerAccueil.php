<?php
require_once File::build_path(array('model','ModelCompte.php')); // chargement du modèle
class ControllerAccueil {

    public static function afficher(){
    	
        $controller = 'accueil';
        $view = 'accueil';
        $pagetitle = 'Accueil';
        require_once File::build_path(array('view','view.php'));
    }

    public static function erreur(){
        $controller = 'accueil';
        $view = 'erreur';
        $pagetitle = "Error BDD";
        require_once File::build_path(array('view','view.php'));
    }
}
?>