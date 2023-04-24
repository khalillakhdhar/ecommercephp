<?php
session_start();

if (!isset($_SESSION['id_client'])) {
    // Si le client n'est pas connecté, redirection vers la page de connexion
    header('Location: connexion.php');
    exit();
}

// Récupération de l'id du client connecté
$id_client = $_SESSION['id_client'];

// Connexion à la base de données
include('config.php');

// Récupération des commandes du client connecté
$query = "SELECT * FROM commande WHERE id_client = $id_client ORDER BY date_commande DESC";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Commandes</title>
    <!-- Liens CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('./menu_client.php'); ?>
    <div class="container">
        <h1>Commandes</h1>
        <?php
        if ($result->num_rows > 0) {
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Numéro de commande</th>';
            echo '<th>Date de commande</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['date_commande'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>Aucune commande passée.</p>';
        }
        ?>
    </div>
</body>
</html>
