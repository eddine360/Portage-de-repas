<?php
if(isset($_SESSION['id'])){											//Si un utilisateur est connecte
			
	header('Location: ./index.php');
}
elseif(isset($_POST['login']) && isset($_POST['mot_de_passe'])){
	require_once ('./lib/bdd.php');
  require_once ('./lib/Security.php'));
  $sql="SELECT * FROM compte WHERE identifiant=$1 AND mdp=$2";
	$req_prep = pg_prepare(Model::$idc, "requête de vérification login, mot de passe", $sql);
	$values = array($_POST['login'], Security::chiffrer($_POST['mot_de_passe']));

	$result = pg_execute(Model::$idc, "requête de vérification login, mot de passe", $values);

	if (pg_numrows($result) != 1){
		$msg = "erreur : votre compte n'a pas pu être trouvé !"
	}
	else {
    $_SESSION['id'] = pg_fetch_row($result)[0];
    $_SESSION['type'] = pg_fetch_row($result)[3];
		header('Location: ./index.php');
	}
}

echo  '<form method="post" action="./connexion.php">
    <fieldset>
      <legend>Connectez vous :</legend>
      <p>
        <label for="login">Identifiant :</label> :
        <input type="text" placeholder="Ex : MonLogin" name="login" id="loginc" required/>
      </p>
      <p>
        <label for="mdp">Mot de Passe :</label> :
        <input type="password" placeholder="Ex : MonMDP" name="mot_de_passe" id="mdpc" required/>
      </p>
      <p>
        <input id="connexion" type="submit" value="Envoyer" />
      </p>
    </fieldset>
  </form>'

?>
