<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<!-- Ajout de Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Mon Site E-commerce</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php">Accueil</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="inscription.php"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2>Connexion</h2>
				<?php
                session_start();
					if(isset($_POST['connexion'])) {
						// Récupération des informations du formulaire
						$login = $_POST['login'];
						$mdp = $_POST['mdp'];

						// Connexion à la base de données
						include('config.php');

						// Vérification des informations de connexion
						$query = "SELECT * FROM client WHERE username = '$login' AND mdp = '$mdp'";
						$result = $conn->query($query) or die($conn->error);
                        //echo $result->num_rows;
                        echo $result->num_rows.' '.$login.' '.$mdp;
                        // récupération de l'id du client
                        $row = $result->fetch_assoc();
                        $id_client = $row['id'];
						if ( $result->num_rows > 0) {
                            //echo '<script>window.location.href = "commandes.php";</script>';
                            echo 'ok';
                            // variable de session $_SESSION['id_client']
                            $_SESSION['id_client'] = $id_client;
                            echo $_SESSION['id_client'];
                            header('Location: commandes.php');
							// Informations de connexion correctes, redirection vers la page d'accueil
							//header('Location: commandes.php');
                            //

							exit();
						} else {
							// Informations de connexion incorrectes, affichage d'un message d'erreur
							echo '<div class="alert alert-danger">Identifiant ou mot de passe incorrect.</div>';
						}

						// Fermeture de la connexion à la base de données
						$conn->close();
					}
				?>
				<form method="POST">
					<div class="form-group">
						<label for="login">Login :</label>
						<input type="text" class="form-control" id="login" name="login" required>
					</div>
					<div class="form-group">
						<label for="password">Mot de passe :</label>
						<input type="password" class="form-control" id="password" name="mdp" required>
					</div>
					<button type="submit" class="btn btn-primary" name="connexion">Connexion</button>
				</form>
				<br>
				<a href="inscription.php">Créer un compte</a>
			</div>
		</div>
	</div>
</body>
</html>
