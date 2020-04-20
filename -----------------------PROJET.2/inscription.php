<?php
if(isset($_SESSION['id'])){											//Si un utilisateur est connecte
			
	header('Location: ./index.php');
}
elseif(isset($_POST['login']) && isset($_POST['mot_de_passe'])){
	require_once ('./lib/bdd.php');
	require_once ('./lib/Security.php'));
	$statement = "INSERT INTO compte (identifiant, mdp, num_type_co)
            VALUES ($1, $2, $3)";

	$req_prep = pg_prepare(Model::$idc, "requête de création de compte", $statement);
	$values = array($_POST['login'], Security::chiffrer($_POST['mot_de_passe']), 2);
	$result = pg_execute(Model::$idc, "requête de création de compte", $values);
	if (pg_affected_rows($result) < 1){
		$msg = "erreur : votre compte n'a pas pu être créé !"
	}
	else {
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
			header('Location: ./compte.php');
		}
	}
}

echo  "<div class='row'>
		<div class='col-md-6'>
		
			<form method='post' action='./inscription.php'>
		  	<fieldset class='row'>
		    	<legend>Inscrivez vous :</legend>

					<p><label for='login'>Identifiant :</label></p>
					<p><input type='text' placeholder='Ex : MonLogin' name='login' id='logini' required/></p>
					<p><label for='mdp'>Mot de Passe :</label></p>
					<p><input type='password' placeholder='Ex : MonMDP' name='mot_de_passe' id='mdpi' required/></p>
					<p><label for='mdp-confirm'>Confirmer le mot de Passe :</label></p>
					<p><input type='password' placeholder='Ex : MonMDP' name='confirm_mot_de_passe' id='mdp-confirm' required/></p>
	      	<p><input id='inscription' type='submit' value='Envoyer'></p>
	        
		  	</fieldset>
			</form>
		</div>

		<div class='col-md-6'>"
		
			include "./connexion.php";
		
echo  "</div></div>"
/*<script type='text/javascript'>
    function check(){
        if(document.getElementById('mdp-confirm').value != document.getElementById('mdpi').value){
            document.getElementById('inscription').disabled = 'disabled';
		}
		if(document.getElementById('logini').value){
			document.getElementById('inscription').disabled = 'disabled';
		}
        if(document.getElementById('mdp-confirm').value == document.getElementById('mdpi').value && document.getElementById('logini').value){
            document.getElementById('inscription').disabled = '';
        }
    }
</script>*/

?>
