<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une catégorie</title>
    <!-- Liens CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('menu_admin.php'); ?>
    <div class="container">
        <h1>Modifier une catégorie</h1>
        <?php
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

            // Récupération de l'identifiant de la catégorie à modifier
            $id = $_GET['id'];

            // Récupération des données de la catégorie à modifier
            $query = "SELECT * FROM categorie WHERE id='$id'";
            $result = $conn->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
        ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="libelle">Libellé :</label>
                <input type="text" class="form-control" id="libelle" name="libelle" value="<?php echo $row['libelle']; ?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
        </form>
        <?php
            } else {
                echo "Aucune catégorie trouvée.";
            }

            // Fermeture de la connexion à la base de données
            $conn->close();
        ?>
    </div>
    <!-- Liens JavaScript Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Consulter les articles</title>
    <!-- Liens CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('menu_admin.php'); ?>
    <div class="container">
        <h1>Consulter les articles</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Désignation</th>
                    <th>Prix unitaire</th>
                    <th>Rayon</th>
                    <th>Sous-rayon</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Connexion à la base de données
                    include('config.php');

                    // Récupération des données des articles
                    $query = "SELECT * FROM article";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['code'] . '</td>';
                            echo '<td>' . $row['designation'] . '</td>';
                            echo '<td>' . $row['prixU'] . '</td>';
                            echo '<td>' . $row['rayon'] . '</td>';
                            echo '<td>' . $row['ssrayon'] . '</td>';
                            echo '<td><a href="article_edit.php?code=' . $row['code'] . '">Modifier</a> | <a href="article_delete.php?code=' . $row['code'] . '">Supprimer</a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="6">Aucun article trouvé</td></tr>';
                    }

                    // Fermeture de la connexion
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <!-- Liens JavaScript Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
