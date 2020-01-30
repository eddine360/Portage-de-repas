<?php
require_once File::build_path(array('config','Conf.php'));
class Model{

    public static $idc;

    public static function Init(){

        $login = Conf::getLogin();
        $hostaddr = Conf::getHostaddr();
        $database_name = Conf::getDatabase();
        $password = Conf::getPassword();
		
		

       	try{
            //self::$pdo = new PDO("pgsql:hostaddr=$hostname;port=5432;dbname=$database_name;user=$login;password=$password");
			self::$idc = pg_connect("hostaddr=10.11.159.20 port=5432 user=postgres password=postgres dbname=Portage_de_repas_Bram");
            // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
            //self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if (empty(self::$idc) OR self::$idc == NULL OR !self::$idc) {
				echo "La connexion a la base " + $database_name +" a échouée\n <a href=\"\"> retour a la page d\'accueil </a>";
				exit();
			}
            
            
        } catch (Exception $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            exit();
        }
		
    }
}
Model::Init();
