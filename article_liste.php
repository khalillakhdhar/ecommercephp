<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des articles</title>
    <!-- Liens CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('menu_admin.php'); ?>
    <div class="container">
        <h1>Liste des articles</h1>
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

            // Récupération des articles depuis la base de données
            $query = "SELECT * FROM article";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                // Affichage des articles dans un tableau
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Code</th>';
                echo '<th>Désignation</th>';
                echo '<th>Prix unitaire</th>';
                echo '<th>Rayon</th>';
                echo '<th>Sous-rayon</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                   
                    echo '<td>'.$row['code'].'</td>';
                    echo '<td>'.$row['designation'].'</td>';
                    echo '<td>'.$row['prixU'].'</td>';
                    echo '<td>'.$row['rayon'].'</td>';
                    echo '<td>'.$row['ssrayon'].'</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo "Aucun article trouvé.";
            }
    
            // Fermeture de la connexion à la base de données
            $conn->close();
        ?>
    </div>
    </body>
</html>    