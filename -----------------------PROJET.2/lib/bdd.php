<?php

class Model{

    public static $idc;

    public static function Init(){

            //self::$pdo = new PDO("pgsql:hostaddr=$hostname;port=5432;dbname=$database_name;user=$login;password=$password");
			self::$idc = pg_connect("hostaddr=127.0.0.1 port=5433 user=postgres password=postgres dbname=Portage_de_repas_Bram");
            // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
            //self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if (empty(self::$idc) OR self::$idc == NULL OR !self::$idc) {
				echo "La connexion a la base de données a échouée\n <a href=\"\"> retour a la page d\'accueil </a>";
				exit();
            }
            
    }
}
Model::Init();
