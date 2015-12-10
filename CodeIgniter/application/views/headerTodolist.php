
<!DOCTYPE html>
<html>
	<head>
	  <meta charset="utf-8">
	  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600,600italic,400italic,300italic,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url("assets/css/styleTodolist.css"); ?>" />

	  <title>Todo - ma Todolist</title>
	</head>
	<body>
		<!-- header de la todolist (connecté) -->
	 <header>
		<h1> Bienvenue sur ToDo, <?php echo $this->session->userdata['nomuser']; ?> !</h1>
	  </header>