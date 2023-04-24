<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
</head>
<body>
	<h1>Inscription</h1>
	<?php
		if(isset($_POST['inscription'])) {
			// Récupération des informations du formulaire
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$adresse = $_POST['adresse'];
			$telephone = $_POST['telephone'];
			$login = $_POST['login'];
			$password = $_POST['password'];

			// Connexion à la base de données
			include('config.php');

			// Vérification de l'existence du login
			$query = "SELECT * FROM client WHERE login = '$login'";
			$result = $conn->query($query);

			if ($result->num_rows > 0) {
				// Login déjà utilisé, affichage d'un message d'erreur
				echo '<p style="color: red;">Ce login est déjà utilisé. Veuillez en choisir un autre.</p>';
			} else {
				// Insertion du nouveau client dans la base de données
				$query = "INSERT INTO client (nom, prenom, adresse, telephone, username, mdp) VALUES ('$nom', '$prenom', '$adresse', '$telephone', '$login', '$password')";
				if ($conn->query($query) === TRUE) {
				    // Redirection vers la page de connexion
				    header('Location: connexion.php');
				    exit();
				} else {
					// Erreur lors de l'insertion, affichage d'un message d'erreur
					echo '<p style="color: red;">Une erreur est survenue lors de l\'inscription.</p>';
                    echo '<p style="color: red;">Une erreur est survenue. Veuillez réessayer plus tard.</p>';
				}
			}

			// Fermeture de la connexion
			$conn->close();
		}
	?>
	<form method="POST">
		<div>
			<label>Nom :</label>
			<input type="text" name="nom" required>
		</div>
		<div>
			<label>Prénom :</label>
			<input type="text" name="prenom" required>
		</div>
		<div>
			<label>Adresse :</label>
			<input type="text" name="adresse" required>
		</div>
		<div>
			<label>Téléphone :</label>
			<input type="text" name="telephone" required>
		</div>
		<div>
			<label>Login :</label>
			<input type="text" name="login" required>
		</div>
		<div>
			<label>Mot de passe :</label>
			<input type="password" name="password" required>
		</div>
		<div>
			<input type="submit" name="inscription" value="S'inscrire">
		</div>
	</form>
	<p>Déjà inscrit ? <a href="connexion.php">Connectez-vous</a></p>
</body>
</html>

