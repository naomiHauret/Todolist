 <!-- formulaire d'inscription -->
	<a name="inscription"></a>
	  <section id="inscrire"> 
		<article>
			<h2>Tout ce dont vous avez besoin pour utiliser <text class="todo">ToDo</text>, c'est une connexion internet et un compte utilisateur. </h2>
			<p>
				Alors, qu'attendez-vous pour vous inscrire? Vous n'avez qu'à remplir ce petit formulaire.
			</p>
		
		<?php			
			$attributes = array('id' => 'formInscription');
			echo form_open('projettodo/inscription', $attributes);
		?>
				 <input type="text" name="usernameInscription" placeholder="Nom d'utilisateur"/><br/>
				 <input type="text"  name="mailInscription" placeholder="E-mail"/><br/>
				<input type="password"  name="passInscription" placeholder="Mot de passe"/><br/><br/>
				<input type="submit" name="M'inscrire" value="M'inscrire" />
			</form>	
			<?php if (isset($register_errors)) echo $register_errors; ?>

		</article>
	  </section>