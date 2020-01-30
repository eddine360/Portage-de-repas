<?php
require_once File::build_path(array('model','ModelCompte.php'));// chargement du modèle
class ControllerCompte {


	public static function compte(){											//Gère le bouton utilisateur
		if(isset($_SESSION['id_connexion'])){											//Si un utilisateur est connecte
			
			$v=  ModelCompte::getAllInfoCompte();
			$controller='compte';
			$view='profil';
			$pagetitle="Compte";
			require_once File::build_path(array('view','view.php'));
		}
		else{																			//sinon le redirige vers la page de connection ou creation de compte
			$controller='compte';
			$view='inscription';
			$pagetitle="S'inscrire/Se Connecter";
			require_once File::build_path(array('view','view.php'));
		}
	}

	public static function create(){
		if(isset($_SESSION['id'])){											//Si un utilisateur est connecte
			
			header('Location: ./index.php');
		}
		else{									//redirige vers les formulaire d'inscription et de connexion
			$controller='compte';
			$view='inscription';
			$pagetitle="S'inscrire";
			require_once File::build_path(array('view','view.php'));
		}
	}

	public static function created(){									//après le formulaire de creation d'un compte afin de l'enregistrer dans la BDD
		
		$login=$_POST['login'];
		
		if (ModelCompte::verifLogin($login)){												//verifie si le login est déjà utilisé
			
			$controller='compte';
			$view='inscription';
			$pagetitle="Erreur d'inscription !";
			$_POST['error'] = "Cet identifiant n'est pas disponible !";
			require_once File::build_path(array('view','view.php'));	//renvoie sur la page d'inscription
			
		}
		else{															//si le nom d'utilisateur est disponible
			$utilisateur1 = new ModelCompte(NULL, $_POST['login'], $_POST['mot_de_passe'], 2);		//enregistre l'utilisateur dans la BDD en tant que bénéficiaire
			$utilisateur1->save();
		
			$controller='compte';
			$view='inscription';
			$pagetitle="Connexion";
			require_once File::build_path(array('view','view.php'));
			
		}
	}

	public static function registred(){									//fonction de connexion
		
		$login=$_POST['login'];
		$motDePasse=$_POST['mot_de_passe'];
		
		$connect = ModelCompte::checkPassword($login, $motDePasse);
		
		if (($connect==false)){
			$_SESSION['connect_fail']=1;
			$controller='compte';
			$view='inscription';
			$pagetitle='Erreur de Connexion';
			if (ModelCompte::verifLogin($login)) {
				$_POST['error'] = "Mauvais mot de passe!";
			} else {
				$_POST['error'] = "Identifiant non reconnu !";
			}
			
			require_once File::build_path(array('view','view.php'));
		}
		else{
			
			$_SESSION['id'] = $connect->getId();
			$_SESSION['type'] = $connect->getTypeCompte();
			$_SESSION['welcome']=1;
			header('Location: ./index.php');
			
		}
	}
	
	public static function deconnect(){									//fonction permettant la deconnexion
		if (!empty($_SESSION['id'])){
			$_SESSION['confirm_deconnect']=1;
			session_unset($_SESSION['id']);
			session_unset($_SESSION['type']);
			header('Location: ./index.php');
		}else{
			header('Location: ./index.php');
		}
	}

	public static function modif(){										//fonction qui affiche le formulaire qui permet à l'utilisateur de modifier son compte
		$controller='compte';
		$view='modifier_profil';
		$pagetitle='Modification Profil';
		require_once File::build_path(array('view','view.php'));
	}

	public static function modified(){									//valide les modifications
		if ($_POST['mot_de_passe'] != null){
			ModelCompte::addMdp($_POST['mot_de_passe'],$_SESSION['login']);
		}
		
		$v=  ModelCompte::getAllInfoCompte();
		$controller='compte';
		$view='profil';
		$pagetitle='Compte';
		require_once File::build_path(array('view','view.php'));
	}

	public static function listCompte(){										//affiche pour l'admin la liste des utilisateur
		if (isset($_SESSION['type'])){
			if($_SESSION['type'] == 1){
				$tab_u=  ModelCompte::getAllUsers();
				$controller='compte';
				$view='listeU';
				$pagetitle='Liste des Utilisateurs';
				require_once File::build_path(array('view','view.php'));
			}
			else {header('Location: ./index.php');}
		}
		else {header('Location: ./index.php');}
	}

	public static function delete(){									//permet à l'admin de delete
		if (isset($_SESSION['type'])){
			if($_SESSION['type'] == 1){
				ModelCompte::deleted($_GET['id']);
				$tab_u=  ModelCompte::getAllUsers();
				$controller='compte';
				$view='listeU';
				$pagetitle='Liste des Utilisateurs';
				require_once File::build_path(array('view','view.php'));
			}
			else {header('Location: ./index.php');}
		}
		else {header('Location: ./index.php');}
	}

}