<?php 
	
	class Projettodo extends CI_Controller{
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function __construct(){ //constructeur de notre contrôleur
			parent::__construct();
			$this->load->model('projettodo_model'); //on charge le modèle qu'on va utiliser dans notre contrôleur
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//notre page d'accueil complète
		public function index() {					
			$this->load->view('headerAccueil');
			$this->load->view('menu_nonConnecte');
			$this->load->view('description');
			$this->load->view('formInscription');
			$this->load->view('formConnexion');
			$this->load->view('footer');
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//notre page d'accueil complète
		public function accueil() {					
			$this->load->view('headerAccueil');
			$this->load->view('menu_connecte');
			$this->load->view('description');
			$this->load->view('footer');
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//permet à un utilisateur anonyme de s'inscrire à l'application
		public function inscription(){
			
			//règles
			$this->form_validation->set_rules('usernameInscription', 'Nom', 'required');
			$this->form_validation->set_rules('mailInscription', 'Email', 'required|is_unique[user.mailuser]');
			$this->form_validation->set_rules('passInscription', 'Mot de passe', 'required');
			 
			if ($this->form_validation->run()) {//cas: formulaire fonctionnel
				
				$this->projettodo_model->user_add_user(); //ajout de la tâche à la base (on fait appel à la méthode todo_add_task de notre model Todo_model)
				
				$mail =$this->input->post('mailInscription');
				$nom=$this->projettodo_model->get_nomuser($mail);
				$id=$this->projettodo_model->get_iduser($mail);
				
				//variables de session
				$this->session->set_userdata( array( //création de la variable de session contenant le nom de l'utilisateur
							'nomuser'=>$nom,
							'id'=>$id,
							'mail'=>$mail
						)
					);
			
				$data['tasklist'] =$this->projettodo_model->get_tasks($mail); //on charge dans un tableau les différentes tâches de la todolist de l'utilisateur
				
				//vue
				$this->load->view('headerTodolist');	
				$this->load->view('menu_connecte');
				$this->load->view('formTask');
				$this->load->view('todolist', $data);
				$this->load->view('footer');
			}
			else {	//cas: formulaire non fonctionnel, utilisateur déjà présent dans la base
				$data['register_errors'] = validation_errors();
				$this->index();
			}
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//permet à un utilisateur déjà inscrit de se connecter à l'application
		public function connexion(){
			
			//règles
			$this->form_validation->set_rules('mailConnexion', 'Email', 'required');
			$this->form_validation->set_rules('passConnexion', 'Mot de passe', 'required');
			 
			if ($this->form_validation->run()){  //cas: formulaire fonctionnel
			
				if($this->projettodo_model->fetch_user($this->input->post('mailConnexion'), $this->input->post('passConnexion')) > 0 ){ //cas: login et mot de passe qui matchent
					$mail =$this->input->post('mailConnexion');
					$nom=$this->projettodo_model->get_nomuser($mail);
					$id=$this->projettodo_model->get_iduser($mail);
					
					 $this->session->set_userdata( array( //création de la variable de session contenant le nom de l'utilisateur
							'nomuser'=>$nom,
							'id'=>$id,
							'mail'=>$mail
						)
					);
					
					
					$data['tasklist'] =$this->projettodo_model->get_tasks($mail); //on charge dans un tableau les différentes tâches de la todolist de l'utilisateur

					//vues
					$this->load->view('headerTodolist');	
					$this->load->view('menu_connecte');
					$this->load->view('formTask');
					$this->load->view('todolist', $data);
					$this->load->view('footer');
				}
					
				else{ //cas: login et mot de passe qui ne matchent pas
					//erreurs
					$data['login_errors'] = validation_errors();
					$this->index();
				}
			}
			else { //cas: formulaire non fonctionnel
				
				$data['login_errors'] = validation_errors();
				$this->index();
			}
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function deconnexion(){
			$this->index();
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		public function todolist(){
			$nom=$this->session->userdata['nomuser'];
			$mail=$this->session->userdata['mail'];
			$id=$this->session->userdata['id'];
					 
			$data['tasklist'] =$this->projettodo_model->get_tasks($mail); 
					
			//vues
			$this->load->view('headerTodolist');	
			$this->load->view('menu_connecte');
			$this->load->view('formTask');
			$this->load->view('todolist', $data);
			$this->load->view('footer');
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//ajoute une tâche à la todolist de l'utilisateur
		public function createTask(){			
			//règle
			$this->form_validation->set_rules('tache', 'Intitulé', 'required');
			
			if ($this->form_validation->run()){  //cas: formulaire fonctionnel
				$id=$this->session->userdata['id'];
				$mail=$this->session->userdata['mail'];
				$this->projettodo_model->add_task($id);
				
				$this->load->view('headerTodolist');	
				$this->load->view('menu_connecte');
				$this->load->view('formTask');
				$data['tasklist'] =$this->projettodo_model->get_tasks($mail);
				$this->load->view('todolist', $data);
				$this->load->view('footer');
			}	
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//supprime une tâcge de la todolist de l'utilisateur
		public function delete($taskid) {
		
			$this->projettodo_model->delete_task($taskid);
			
			$id=$this->session->userdata['id'];
			$mail=$this->session->userdata['mail'];
			
			$this->load->view('headerTodolist');	
			$this->load->view('menu_connecte');
			$this->load->view('formTask');
			$data['tasklist'] =$this->projettodo_model->get_tasks($mail);
			$this->load->view('todolist', $data);
			$this->load->view('footer');
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	}

?>