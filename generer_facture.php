<?php
session_start();

if ($_SESSION['statut'] == 1 && count($_SESSION['PanierRef']) != 0) {
    $nom = $_SESSION['nom']."".$_SESSION['prenom'];
    $file = fopen("facture".$nom.".txt", "w+");
    fwrite($file, "Voici votre facture : \n");

    $total = 0;
    for($i=0; $i< count($_SESSION['PanierNom']); $i++){
        $panier = $_SESSION['PanierNom'][$i];
        $prix = $_SESSION['PanierPrix'][$i];
        $qte = $_SESSION['PanierQte'][$i];
        
        fwrite($file, $panier." x ".$qte.": ".($prix * $qte)."€\n");
        
        $total += ($qte * $prix);
    }

    fwrite($file, "Total : ".$total."€\n");
    fwrite($file, "Nombre total de produits achetés : ".array_sum($_SESSION['PanierQte'])."\n");

    fclose($file);

    // Redirection vers une page de confirmation ou autre après avoir généré la facture
    header('Location: mail.php');
} else {
    echo "Erreur : impossible de générer la facture.";
}
?>
