<?php
session_start();
error_reporting(0);

// Vérifier si la référence du produit est fournie dans l'URL
if (!isset($_GET['ref'])) {
    http_response_code(400);
    exit("Référence du produit manquante");
}

$ref = $_GET['ref'];
// Maintenant vous pouvez utiliser $ref pour supprimer le produit

// Vérifier si l'utilisateur est connecté ou a les autorisations nécessaires
if ($_SESSION['statut'] != 5) {
    http_response_code(403);
    exit("Accès refusé");
}

// Chemin du fichier CSV
$csvFile = "./data/catalogue.csv";

// Ouvrir le fichier CSV en mode lecture et écriture
$file = fopen($csvFile, "r+");

if ($file !== false) {
    // Initialiser un tableau pour stocker les lignes du fichier CSV
    $csvData = [];

    // Lire chaque ligne du fichier CSV
    while (($data = fgetcsv($file, 1000, ",")) !== false) {
        // Vérifier si la référence du produit dans la ligne correspond à celle à supprimer
        if ($data[4] != $ref) {
            // Ajouter la ligne au tableau si la référence ne correspond pas
            $csvData[] = $data;
        }
    }

    // Retourner au début du fichier
    rewind($file);

    // Tronquer le fichier pour le vider
    ftruncate($file, 0);

    // Réécrire les lignes valides dans le fichier
    foreach ($csvData as $line) {
        fputcsv($file, $line);
    }

    // Fermer le fichier
    fclose($file);

    // Message de succès
    echo "Le produit avec la référence $ref a été supprimé avec succès<br>";
    echo "Redirection en cours...";
    echo "<script>setTimeout(function() { window.location.href = '{$_SERVER['HTTP_REFERER']}'; }, 3000);</script>";
} else {
    // Erreur d'ouverture du fichier
    http_response_code(500);
    echo "Erreur lors de l'ouverture du fichier CSV";
}
?>
