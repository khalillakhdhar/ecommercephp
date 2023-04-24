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
