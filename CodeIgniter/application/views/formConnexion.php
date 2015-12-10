
	<!-- formulaire de connexion -->
	 <section id="connex"> <a name="connexion"></a>
		<article>
			<h2>Oh, vous utilisez déjà <text class="todo">ToDo</text> ?</h2>
				<p>
					Il ne vous reste plus qu'à vous connectez alors.
				</p>
			
		   <?php			
				$attributes = array('id' => 'formConnexion');
				echo form_open('projettodo/connexion', $attributes);
			?>
				<input type="text"  name="mailConnexion" placeholder="E-mail"/><br/>
				<input type="password"  name="passConnexion" placeholder="Mot de passe"/><br/><br/>
				<input type="submit"  name="Me connecter" value="Me connecter" /><br/>

			</form>
				<?php if (isset($login_errors)) echo $login_errors; ?>

		</article>
	  </section>
