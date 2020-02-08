  <div class="row">
	<div class="col-md-6">
		
		<form method="post" action="./index.php?controller=compte&action=created">
		  <fieldset class="row">
		    <legend>Inscrivez vous :</legend>

			<p><label for="login">Identifiant :</label></p>
			<p><input type="text" placeholder="Ex : MonLogin" name="login" id="login" required/></p>
			<p><label for="mdp">Mot de Passe :</label></p>
			<p><input type="password" placeholder="Ex : MonMDP" name="mot_de_passe" id="mdp" required/></p>
			<p><label for="mdp-confirm">Confirmer le mot de Passe :</label></p>
			<p><input type="password" placeholder="Ex : MonMDP" name="confirm_mot_de_passe" id="mdp-confirm" required/></p>
	        <p><input type="submit" value="Envoyer"/></p>
	        
		  </fieldset>
		</form>
	</div>

	<div class="col-md-6">
		<?php
			$filepath = File::build_path(array("view", $controller, "$view.php"));
			require $filepath;
		?>
	</div>
  </div>
