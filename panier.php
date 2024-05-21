<?php
session_start();
error_reporting(0);
include 'header.php'; 
?>

<style>
    /* Styles pour réduire la taille du bouton et de la colonne Quantité */
    .quantity-input {
        width: 50px;
        text-align: center;
        margin-right: 420px;
    }
    .change-quantity-button {
        font-size: 12px;
        padding: 2px 5px;
        margin-right: 420px; /* Ajout de la marge à droite */
    }
    .quantity-column {
        width: 150px;
    }
    table {
        width: 100%;
    }
    td, th {
        text-align: center;
        padding: 10px;
    }
    .photoPanier {
        max-width: 100px;
        max-height: 100px;
    }
</style>

<div id="Page">
    <h3>Votre Panier</h3>

    <?php
    // Initialiser le total
    $total = 0;

    if (!isset($_SESSION['PanierRef']) || empty($_SESSION['PanierRef'])) {
        // Si le panier est vide
        echo "Votre panier est vide. ";
        echo "<a href='catalogue.php?cat=1'>Retour vers le catalogue</a>";
        
    } else {
        // Afficher le contenu du panier
        echo "<table border='1'>";
        echo "<thead><tr><th>Nom</th><th>Photo</th><th>Ref</th><th>Prix</th><th class='quantity-column'>Quantité</th><th>Total Article</th></tr></thead>";

        for ($i = 0; $i < count($_SESSION['PanierNom']); $i++) {
            // Si la quantité est 0, ne pas afficher cet article et passer au suivant
            if ($_SESSION['PanierQte'][$i] == 0) {
                continue;
            }

            // Calculer le total pour chaque article
            $article_total = $_SESSION['PanierQte'][$i] * $_SESSION['PanierPrix'][$i];
            $total += $article_total;

            // Afficher les détails de l'article
            echo "<tr>";
            echo "<td>" . htmlspecialchars($_SESSION['PanierNom'][$i]) . "</td>";
            echo "<td><img class='photoPanier' src='./img/" . htmlspecialchars($_SESSION['PanierImg'][$i]) . "'></td>";
            echo "<td>" . htmlspecialchars($_SESSION['PanierRef'][$i]) . "</td>";
            echo "<td>" . htmlspecialchars($_SESSION['PanierPrix'][$i]) . "€</td>";

            // Formulaire pour changer la quantité
            echo "<td class='quantity-column'>";
            echo "<form action='' method='POST' style='display: flex; flex-direction: column; align-items: center;'>";
            echo "<input type='number' name='new_quantity' value='" . htmlspecialchars($_SESSION['PanierQte'][$i]) . "' min='0' class='quantity-input'>";
            echo "<input type='hidden' name='item_index' value='$i'>";
            echo "<button type='submit' name='change_quantity' class='change-quantity-button'>Changer la quantité</button>";
            echo "</form>";
            echo "</td>";

            echo "<td>" . htmlspecialchars($article_total) . "€</td>";
            echo "</tr>";
        }

        // Afficher le total du panier
        echo "<tr><td>Total</td><td colspan='5'>" . htmlspecialchars($total) . "€</td></tr>";

        // Bouton pour valider la commande
        echo "<tr><td colspan='6'>";
        echo "<form action='panierNM.php' method='POST'>";
        echo "<input type='submit' name='valider' value='Valider la commande'>";
        echo "</form>";
        echo "</td></tr>";

        // Bouton pour vider le panier
        echo "<tr><td colspan='6'>";
        echo "<form action='' method='POST'>";
        echo "<input type='submit' name='reset' value='Vider le panier'>";
        echo "</form>";
        echo "</td></tr>";

        echo "</table>";

        // Vérifier si le bouton "Changer la quantité" a été soumis
        if (isset($_POST['change_quantity'])) {
            $index = $_POST['item_index'];
            $new_quantity = $_POST['new_quantity'];

            // Mettre à jour la quantité dans le panier
            $_SESSION['PanierQte'][$index] = $new_quantity;

            // Si la nouvelle quantité est 0, retirer l'article du panier
            if ($new_quantity == 0) {
                unset($_SESSION['PanierRef'][$index]);
                unset($_SESSION['PanierQte'][$index]);
                unset($_SESSION['PanierImg'][$index]);
                unset($_SESSION['PanierNom'][$index]);
                unset($_SESSION['PanierPrix'][$index]);

                // Réindexer les tableaux pour éviter les clés manquantes
                $_SESSION['PanierRef'] = array_values($_SESSION['PanierRef']);
                $_SESSION['PanierQte'] = array_values($_SESSION['PanierQte']);
                $_SESSION['PanierImg'] = array_values($_SESSION['PanierImg']);
                $_SESSION['PanierNom'] = array_values($_SESSION['PanierNom']);
                $_SESSION['PanierPrix'] = array_values($_SESSION['PanierPrix']);
            }

            // Actualiser la page pour refléter les changements
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }

        // Vérifier si le bouton "Vider le panier" a été soumis
        if (isset($_POST['reset'])) {
            // Vider le panier
            $_SESSION['PanierRef'] = array();
            $_SESSION['PanierQte'] = array();
            $_SESSION['PanierImg'] = array();
            $_SESSION['PanierNom'] = array();
            $_SESSION['PanierPrix'] = array();
            $_SESSION['PanierCat'] = array();

            // Actualiser la page pour refléter les changements
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }
    }
    ?>

</div>
<br><br><br><br><br><br><br><br>
<?php
include 'footer.php';
?>
