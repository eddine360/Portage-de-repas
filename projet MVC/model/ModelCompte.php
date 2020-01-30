<?php
class ModelCompte {
  private $id_connexion;
  private $identifiant;
  private $mdp;
  private $num_type_co;

  //getters
  public function getId() {
       return $this->id_connexion;
  }
  
  public function getIdentifiant() {
       return $this->identifiant;
  }

    public function getMDP() {
       return $this->mdp;
  }

    public function getTypeCompte() {
       return $this->num_type_co;
  }

//setters
  public function setIdentifiant($login){
    $this->identifiant = $login;
  }

  public function setMDP($password) {
       $this->mdp = $password;
  }
  
  public function setTypeCompte($type) {
       $this->num_type_co = $type;
  }
  
// un constructeur
public function __construct($id = NULL, $login = NULL, $password = NULL, $type = NULL, $key = NULL) {
  if (!is_null($login) && !is_null($password) && !is_null($type)){
		
		$this->id_connexion = $id;
		$this->identifiant = $login;
		$this->mdp = $password;
		$this->num_type_co = $type;
  }
}

/*public function __construct($login = NULL, $password = NULL, $type = NULL) {
  if (!is_null($login) && !is_null($password) && !is_null($type)){
		require_once File::build_path(array('lib','Security.php'));
		
		$this->identifiant = $login;
		$this->mdp = Security::chiffrer($password);
		$this->num_type_co = $type;
  }
}*/
    
public static function addMdp($mdp,$id){									//permet de modifier le mot de passe dans la BDD
    require_once File::build_path(array('lib','Security.php'));
    require_once File::build_path(array('model','Model.php'));
    $mdp=Security::chiffrer($mdp);
    $sql="UPDATE compte SET mdp=$1 WHERE id_connexion=$2";
    $req_prep = pg_prepare(Model::$idc, "requête de modification de mot de passe",$sql);
    $values = array($mdp, $id);
        
    $result = pg_execute(Model::$idc, "requête de modification de mot de passe", $values);
    return (pg_affected_rows($result) == 1);
}

public static function addType($type,$id){									//permet de modifier le type de l'utilisateur dans la BDD
    require_once File::build_path(array('lib','Security.php'));
    require_once File::build_path(array('model','Model.php'));
    $mdp=Security::chiffrer($mdp);
    $sql="UPDATE compte SET num_type_co=$1 WHERE id_connexion=$2";
    $req_prep = pg_prepare(Model::$idc, "requête de modification du type",$sql);
    $values = array($type, $id);
        
    $result = pg_execute(Model::$idc, "requête de modification du type", $values);
    return (pg_affected_rows($result) == 1);
}

public static function getCompteById($id){
	require_once File::build_path(array('model','Model.php'));
	$sql= "SELECT * FROM compte WHERE id_connexion=$1";
	$req_prep = pg_prepare(Model::$idc, "requête de sélection de compte par son id", $sql);
	$values = array($id);

	$result = pg_execute(Model::$idc, "requête de sélection de compte par son id", $values);
	
	if (pg_numrows($result) <= 0){
    return false;
  }
  else{
  	$line = pg_fetch_row($result);
    return new ModelCompte($line[0], $line[1], $line[2], $line[3]); 
  }
}

public static function verifLogin($login){					//retourne vrai si le login existe dans la BDD
  require_once File::build_path(array('model','Model.php'));
	$sql= "SELECT * FROM compte WHERE identifiant=$1";
	$req_prep = pg_prepare(Model::$idc, "requête de vérification disponibilité d'un identifiant unique", $sql);
	$values = array($login);

	$result = pg_execute(Model::$idc, "requête de vérification disponibilité d'un identifiant unique", $values);
	
	return (pg_num_rows($result) == 1);
}

public static function checkPassword($login, $mot_de_passe){	//retourne le compte ayant l'identifiant et le mot de passe en paramètres s'il existe dans la BDD
	
	require_once File::build_path(array('lib','Security.php'));
    require_once File::build_path(array('model','Model.php'));
    $mdp_chiffre = Security::chiffrer($mot_de_passe);
	$sql="SELECT * FROM compte WHERE identifiant=$1 AND mdp=$2";
	$req_prep = pg_prepare(Model::$idc, "requête de vérification login, mot de passe", $sql);
	$values = array($login, $mdp_chiffre);

	$result = pg_execute(Model::$idc, "requête de vérification login, mot de passe", $values);
	
	$num = pg_numrows($result);

	if ($num <= 0){
    	return false;
	}
	else{
		$line = pg_fetch_row($result);
    	return new ModelCompte($line[0], $line[1], $line[2], $line[3]); 
	}
}

public static function isAdmin($id){							//retourne vrai si il existe un administrateur ayant $id pour clé primaire
        require_once File::build_path(array('model','Model.php'));
	$sql="SELECT * FROM compte WHERE identifiant=$1 AND num_type_co=1";
	$req_prep = pg_prepare(Model::$idc, "requête de vérification des droits d'administration", $sql);
	$values = array($id);
	$result = pg_execute(Model::$idc, "requête de vérification des droits d'administration", $values);
	
	return (pg_num_rows($result) > 0);
}

public function save (){												//enregistre un utilisateur dans la BDD
    require_once File::build_path(array('model','Model.php'));
    require_once File::build_path(array('lib','Security.php'));
    $statement = "INSERT INTO compte (identifiant, mdp, num_type_co)
            VALUES ($1, $2, $3)";

    $req_prep = pg_prepare(Model::$idc, "requête de création de compte", $statement);
    $values = array($this->identifiant, Security::chiffrer($this->mdp), $this->num_type_co);
	$result = pg_execute(Model::$idc, "requête de création de compte", $values);
	return (pg_affected_rows($result)==1);
}

public function getAllInfoCompte(){										//renvoi toute les infos du compte
      require_once File::build_path(array('model','Model.php'));
      $sql = "SELECT * from compte WHERE id_connexion=$1";
      // Préparation de la requète
      $req_prep = pg_prepare(Model::$idc, "requête de sélection du compte utilisé", $sql);

      $values = array($_SESSION['id_connexion']);

      // On donne les valeurs et on execute la requete
      $result = pg_execute(Model::$idc, "requête de sélection du compte utilisé", $values);

      // Attention, si il n'y a pas de resultats, on renvoie false
      if (pg_num_rows($result) <= 0){
        return false;
      }
      else{
      	// On recupere le resultat
      	$line = pg_fetch_row($result);
        return new ModelCompte($line[0], $line[1], $line[2], $line[3]);
      }
}

public static function getAllComptes(){											//renvoie tous les utilisateurs
      require_once File::build_path(array('model','Model.php'));
      $sql = "SELECT * FROM compte";
      
      $result = pg_query(Model::$idc, $sql);
      $nums = pg_num_rows($result);
      if ($nums <= 0){
        return false;
      }
      else{
		for ($i=0; $i < $nums; $i++) { 
			$line = pg_fetch_row($result);
        	$tab_util[$i] = new ModelCompte($line[0], $line[1], $line[2], $line[3]);
		}
        return $tab_util;
      }
}

public static function deleted($id){									//permet de supprimer un utilisateur
      require_once File::build_path(array('model','Model.php'));
      $sql = "DELETE FROM compte WHERE id_connexion=$1";
      $req_prep = pg_prepare(Model::$idc, "requête de suppression d'un compte", $sql);
      $values = array($id);
      $result = pg_execute(Model::$idc, "requête de suppression d'un compte", $values);
	  return (pg_affected_rows($result)==1);
    }
}
