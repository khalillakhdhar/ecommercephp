<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un article</title>
    <!-- Liens CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('menu_admin.php'); ?>
    <div class="container">
        <h1>Ajouter un article</h1>
        <form method="post" action="article_ajout.php">
            <div class="form-group">
                <label for="code">Code :</label>
                <input type="text" class="form-control" id="code" name="code" required>
            </div>
            <div class="form-group">
                <label for="designation">Désignation :</label>
                <input type="text" class="form-control" id="designation" name="designation" required>
            </div>
            <div class="form-group">
                <label for="prixU">Prix unitaire :</label>
                <input type="number" class="form-control" id="prixU" name="prixU" required>
            </div>
            <div class="form-group">
                <label for="rayon">Rayon :</label>
                <input type="text" class="form-control" id="rayon" name="rayon" required>
            </div>
            <div class="form-group">
                <label for="ssrayon">Sous-rayon :</label>
                <input type="text" class="form-control" id="ssrayon" name="ssrayon" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        <?php
            // Traitement de la soumission du formulaire
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupération des données du formulaire
                $code = $_POST['code'];
                $designation = $_POST['designation'];
                $prixU = $_POST['prixU'];
                $rayon = $_POST['rayon'];
                $ssrayon = $_POST['ssrayon'];

                // Connexion à la base de données
                $host = "localhost";
                $user = "root";
                $password = "";
                $database = "commerce";

                $conn = new mysqli($host, $user, $password, $database);

                // Vérification de la connexion
                if ($conn->connect_error) {
                    die("La connexion a échoué : " . $conn->connect_error);
                }

                // Insertion de l'article dans la base de données
                $query = "INSERT INTO article (code, designation, prixU, rayon, ssrayon) VALUES ('$code', '$designation', '$prixU', '$rayon', '$ssrayon')";
                if($conn->query($query) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">L\'article a été ajouté avec succès.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'ajout de l\'article : ' . $conn->error . '</div>';
                }
    
                // Fermeture de la connexion à la base de données
                $conn->close();
            }
        ?>
    </div>
    
    </body>
</html>