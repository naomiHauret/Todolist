	 
	 <!-- formulaire d'ajout de tâche à la todolist -->
	  <section id="formulaire">
		<h2>Ajouter une tâche   <i class="fa  fa-chevron-right animated shake "></i></h2>
		<article> 
		<?php
			echo validation_errors();

		?>
		<?php			
			$attributes = array('id' => 'formTodo');
			echo form_open('projettodo/createTask', $attributes);
		?>
				<input type="text" name="tache" placeholder="Intitulé de la tâche" />
				<input type="submit" value="Créer"/>
		   </form>
		</article>
	  </section>