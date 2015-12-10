
 <!-- la todolist -->
	<section id="todolist">
		<h2>Ma todolist</h2>
		<article> 
			<?php foreach($tasklist as $todo_item): ?>
				<ul>
					<li>
						<?php
						
							echo $todo_item['intitule']." ".anchor('projettodo/delete/'.$todo_item["idtask"],'[suppr]');

							//fonction anchor: crée un lien en se basant sur l'URL de base
						?>
					</li>
				</ul>
			<?php 
				endforeach
			?>

		</article>
	</section>

