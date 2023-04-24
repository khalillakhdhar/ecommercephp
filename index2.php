<!DOCTYPE html>
<html>
<head>
	<title>Page d'accueil</title>
	<!-- Liens CSS Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
	<!-- Barre de navigation -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Mon site</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="index.php">Accueil</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="commandes.php">Panier</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="connexion.php">Connexion</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="inscription.php">Inscription</a>
				</li>
			</ul>
		</div>
	</nav>

	<!-- Contenu de la page -->
	<div class="container mt-5">
	<h1>Bienvenue sur notre site de commerce en ligne !</h1>
	<?php
		// Démarrage ou récupération de la session
		session_start();

		// Si un article a été ajouté au panier
		if(isset($_POST['ajouter'])) {
			// Récupération des informations de l'article
			$code = $_POST['code'];
			$designation = $_POST['designation'];
			$prix = $_POST['prix'];
			$quantite = $_POST['quantite'];

			// Création d'un tableau associatif pour représenter l'article
			$article = array(
				'code' => $code,
				'designation' => $designation,
				'prix' => $prix,
				'quantite' => $quantite
			);

			// Ajout de l'article au panier
			if(isset($_SESSION['panier'])) {
				// Le panier existe déjà, on ajoute simplement l'article
				$_SESSION['panier'][] = $article;
			} else {
				// Le panier n'existe pas encore, on le crée et on ajoute l'article
				$_SESSION['panier'] = array($article);
			}
		}
	?>
	<!-- Affichage des articles -->
	<?php
		// Connexion à la base de données
		include('config.php');

		// Récupération des données des articles
		$query = "SELECT * FROM article";
		$result = $conn->query($query);

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				echo '<div>';
				echo '<h2>' . $row['designation'] . '</h2>';
				echo '<p>Prix unitaire : ' . $row['prixU'] . ' €</p>';
				echo '<form method="POST" action="">';
				echo '<input type="hidden" name="code" value="' . $row['code'] . '">';
				echo '<input type="hidden" name="designation" value="' . $row['designation'] . '">';
				echo '<input type="hidden" name="prix" value="' . $row['prixU'] . '">';
				echo '<label for="quantite">Quantité : </label>';
				echo '<input type="number" name="quantite" value="1">';
				echo '<input type="submit" name="ajouter" value="Ajouter au panier">';
				echo '</form>';
				echo '</div>';
			}
		} else {
			echo '<p>Aucun article trouvé.</p>';
		}

		// Fermeture de la connexion à la base de données
		$conn->close();
	?>
	</div>

	<!-- Liens JavaScript Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
		integrity="sha384-mXltiIKjLnQO+jlFzhsCVtDmNVtYwOwZOIgAjsavxZ9XbTkjL2Zuz+NtbcJnB69G" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
		integrity="sha384-0JhTpBBDQ2XDK4BIq3qH4hJ/Un6UtkIn8Wgh0Y+deV7/lRp0TmKX7nc+Z76GSvz/" crossorigin="anonymous">
	</script>
</body>
</html>
