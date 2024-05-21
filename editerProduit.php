<?php
session_start();
error_reporting(0);

// Vérifier si l'utilisateur a les droits d'administration
if ($_SESSION['statut'] != 5) {
    echo "Vous n'avez pas les droits pour effectuer cette action.";
    exit();
}

// Vérifier si la référence est définie dans la requête GET
if (!isset($_GET['ref'])) {
    echo "Référence du produit manquante.";
    exit();
}

$ref = $_GET['ref'];

// Rechercher les détails du produit dans le fichier CSV
$filename = './data/catalogue.csv';
$productData = null;

if (($handle = fopen($filename, 'r')) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($data[4] == $ref) {
            $productData = $data;
            break;
        }
    }
    fclose($handle);
}

if (!$productData) {
    echo "Produit non trouvé.";
    exit();
}

// Si le formulaire est soumis, mettre à jour le stock
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newStock = (int)$_POST['new_stock'];
    $tempfile = tempnam('.', 'tmp');

    if (($handle = fopen($filename, 'r')) !== FALSE && ($tempHandle = fopen($tempfile, 'w')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($data[4] == $ref) {
                $data[5] = $newStock;
            }
            fputcsv($tempHandle, $data);
        }
        fclose($handle);
        fclose($tempHandle);

        if (!rename($tempfile, $filename)) {
            echo "Erreur lors de la mise à jour du produit.";
            exit();
        } else {
            echo'<script> alert("Stock du produit mis à jour avec succès.")</script>';
            echo "<script>location.href = 'catalogue.php?cat=" . $productData[1] . "';</script>";
        }
    } else {
        echo "Erreur lors de l'ouverture des fichiers.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Éditer Produit</title>
</head>
<body>
    <h1>Éditer le Stock du Produit</h1>
    <form method="post">
        <p>
            <label>Nom du Produit: <?php echo htmlspecialchars($productData[0]); ?></label>
        </p>
        <p>
            <label>Référence: <?php echo htmlspecialchars($productData[4]); ?></label>
        </p>
        <p>
            <label>Nouveau Stock: </label>
            <input type="number" name="new_stock" value="<?php echo htmlspecialchars($productData[5]); ?>" min="0" required>
        </p>
        <p>
            <button type="submit">Mettre à jour</button>
        </p>
    </form>
</body>
</html>
