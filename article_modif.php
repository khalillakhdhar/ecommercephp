<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un article</title>
    <!-- Liens CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('menu_admin.php'); ?>
    <div class="container">
        <h1>Modifier un article</h1>
        <?php
            // Vérification de l'existence du paramètre 'code' dans l'URL
            if (isset($_GET['code'])) {
                $code = $_GET['code'];

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

                // Récupération des données de l'article à modifier
                $query = "SELECT * FROM article WHERE code='$code'";
                $result = $conn->query($query);

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
        ?>
        <form method="post" action="article_modif.php">
            <input type="hidden" name="code" value="<?php echo $row['code']; ?>">
            <div class="form-group">
                <label for="designation">Désignation :</label>
                <input type="text" class="form-control" id="designation" name="designation" value="<?php echo $row['designation']; ?>" required>
            </div>
            <div class="form-group">
                <label for="prixU">Prix unitaire :</label>
                <input type="number" class="form-control" id="prixU" name="prixU" value="<?php echo $row['prixU']; ?>" required>
            </div>
            <div class="form-group">
                <label for="rayon">Rayon :</label>
                <input type="text" class="form-control" id="rayon" name="rayon" value="<?php echo $row['rayon']; ?>" required>
            </div>
            <div class="form-group">
                <label for="ssrayon">Sous-rayon :</label>
                <input type="text" class="form-control" id="ssrayon" name="ssrayon" value="<?php echo $row['ssrayon']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
        <?php
                } else {
                    echo '<div class="alert alert-danger" role="alert">Aucun article trouvé pour le code ' . $code
                        . '.</div>';
                }
            // Vérification de l'existence des données postées
            if (isset($_POST['code']) && isset($_POST['designation']) && isset($_POST['prixU']) && isset($_POST['rayon']) && isset($_POST['ssrayon'])) {
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

                // Mise à jour des données de l'article
                $query = "UPDATE article SET designation='$designation', prixU='$prixU', rayon='$rayon', ssrayon='$ssrayon' WHERE code='$code'";

                if ($conn->query($query) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">L\'article a été modifié avec succès.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Erreur lors de la modification de l\'article : ' . $conn->error . '</div>';
                }

                // Fermeture de la connexion à la base de données
                $conn->close();
            }
        }
    ?>
</div>
</body>
</html>