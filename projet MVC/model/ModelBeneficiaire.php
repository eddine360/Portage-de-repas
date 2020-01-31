<?php
class ModelBeneficiare {
  private $num_benef;
  private $nom_benef;
  private $prenom_benef;
  private $genre;
  private $date_nais_benef;
  private $tel_benef;
  private $cp_benef;
  private $num_fo;
  private $id_connexion;

  //getters
  public function getId() {
       return $this->id_connexion;
  }
  
  public function getNum() {
       return $this->num_benef;
  }

    public function getNom() {
       return $this->nom_benef;
  }
	
	public function getPrenom() {
       return $this->prenomm_benef;
  }

    public function getGenre() {
       return $this->genre;
  }
	
	public function getDateNais() {
       return $this->date_nais_benef;
  }
	
	public function getTel() {
       return $this->tel_benef;
  }
	
	public function getCp() {
       return $this->cp_benef;
  }
	
	public function getNumFo() {
       return $this->num_fo;
  }

//setters
    public function setNom($nom) {
       $this->nom_benef = $nom;
  }
	
	public function setPrenom($prenom) {
       $this->prenom_benef = $prenom;
  }

    public function setGenre($genre) {
       $this->genre = $genre;
  }
	
	public function setDateNais($date) {
       $this->date_nais_benef = $date;
  }
	
	public function setTel($tel) {
       $this->tel_benef = $tel;
  }
	
	public function setCp($cp) {
       $this->cp_benef = $cp;
  }
	
	public function setNumFo($num) {
       $this->num_fo = $num;
  }
  
// un constructeur
public function __construct($numB = NULL, $nom = NULL, $prenom = NULL, $genre = NULL, $date = NULL, $tel = NULL, $cp = NULL, $numF = NULL, $id = NULL) {
  if (!is_null($nom) && !is_null($prenom) && !is_null($genre) && !is_null($date) && !is_null($$tel) && !is_null($cp) && !is_null($numF) && !is_null($id)){
			
		$this->num_benef = $numB;
		$this->nom_benef = $nom;
		$this->prenom_benef = $prenom;
		$this->genre = $genre;
		$this->date_nais_benef = $date;
		$this->tel_benef = $tel;
		$this->cp_benef = $cp;
		$this->num_fo = $num;
		$this->id_connexion = $id;
  }
}
    
public static function getBenefById($id){
	require_once File::build_path(array('model','Model.php'));
	$sql= "SELECT * FROM beneficiaire WHERE id_connexion=$1";
	$req_prep = pg_prepare(Model::$idc, "requête de sélection de bénéficiaire par son id", $sql);
	$values = array($id);

	$result = pg_execute(Model::$idc, "requête de sélection de bénéficiaire par son id", $values);
	
	if (pg_numrows($result) <= 0){
    return false;
  }
  else{
  	$line = pg_fetch_row($result);
    return new ModelBeneficiare($line[0], $line[1], $line[2], $line[3], $line[4], $line[5], $line[6], $line[7], $line[8]); 
  }
}

public static function getBenefByNum($num){
	require_once File::build_path(array('model','Model.php'));
	$sql= "SELECT * FROM beneficiaire WHERE num_benef=$1";
	$req_prep = pg_prepare(Model::$idc, "requête de sélection de bénéficiaire par son num", $sql);
	$values = array($num);

	$result = pg_execute(Model::$idc, "requête de sélection de bénéficiaire par son num", $values);
	
	if (pg_numrows($result) <= 0){
    return false;
  }
  else{
  	$line = pg_fetch_row($result);
    return new ModelBeneficiare($line[0], $line[1], $line[2], $line[3], $line[4], $line[5], $line[6], $line[7], $line[8]); 
  }
}


public function save (){												//enregistre un utilisateur dans la BDD
    require_once File::build_path(array('model','Model.php'));
    
    $statement = "INSERT INTO beneficiaire (nom_benef, prenom_benef, genre, date_nais_benef, tel_benef, cp_benef, num_fo, id_connexion)
            VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";

    $req_prep = pg_prepare(Model::$idc, "requête de création de bénéficiaire", $statement);
    $values = array(
    	$this->nom_benef,
		$this->prenom_benef,
		$this->genre,
		$this->date_nais_benef,
		$this->tel_benef,
		$this->cp_benef,
		$this->num_fo,
		$this->id_connexion);
	$result = pg_execute(Model::$idc, "requête de création de bénéficiaire", $values);
	return (pg_affected_rows($result)==1);
}

public function getAllInfoBenef(){										//renvoi toute les infos du bénéficiaire
      require_once File::build_path(array('model','Model.php'));
      $sql = "SELECT * from beneficiaire WHERE id_connexion=$1";
      // Préparation de la requète
      $req_prep = pg_prepare(Model::$idc, "requête de sélection du compte beneficiaire utilisé", $sql);

      $values = array($_SESSION['id']);

      // On donne les valeurs et on execute la requete
      $result = pg_execute(Model::$idc, "requête de sélection du compte beneficiaire utilisé", $values);

      // Attention, si il n'y a pas de resultats, on renvoie false
      if (pg_num_rows($result) <= 0){
        return false;
      }
      else{
      	// On recupere le resultat
      	$line = pg_fetch_row($result);
        return new ModelBeneficiare($line[0], $line[1], $line[2], $line[3], $line[4], $line[5], $line[6], $line[7], $line[8]);
      }
}

public static function getAllComptes(){											//renvoie tous les utilisateurs
      require_once File::build_path(array('model','Model.php'));
      $sql = "SELECT * FROM beneficiaire";
      
      $result = pg_query(Model::$idc, $sql);
      $nums = pg_num_rows($result);
      if ($nums <= 0){
        return false;
      }
      else{
		for ($i=0; $i < $nums; $i++) { 
			$line = pg_fetch_row($result);
        	$tab_benef[$i] = new ModelBeneficiare($line[0], $line[1], $line[2], $line[3], $line[4], $line[5], $line[6], $line[7], $line[8]);
		}
        return $tab_benef;
      }
}

public static function deleted($id){									//permet de supprimer un utilisateur
      require_once File::build_path(array('model','Model.php'));
      $sql = "DELETE FROM beneficiaire WHERE id_connexion=$1";
      $req_prep = pg_prepare(Model::$idc, "requête de suppression d'un beneficiaire", $sql);
      $values = array($id);
      $result = pg_execute(Model::$idc, "requête de suppression d'un beneficiaire", $values);
	  return (pg_affected_rows($result)==1);
    }
}
