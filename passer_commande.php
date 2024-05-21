<?php
// Récupérer les données de la commande envoyées par AJAX
$cat = $_POST['cat'];
$nom = $_POST['nom'];
$qte = $_POST['qte'];

// Mettre à jour le stock dans le fichier CSV
$catalogue = array_map('str_getcsv', file('./data/catalogue.csv'));
foreach ($catalogue as &$ligne) {
    if ($ligne[1] == $cat && $ligne[0] == $nom) {
        $ligne[5] -= $qte; // Réduire le stock de la quantité commandée
        break;
    }
}
unset($ligne);

// Réécrire le catalogue mis à jour dans le fichier CSV
$file = fopen('./data/catalogue.csv', 'w');
foreach ($catalogue as $ligne) {
    fputcsv($file, $ligne);
}
fclose($file);

// Répondre avec un message de succès
echo "Stock mis à jour avec succès !";
?>
