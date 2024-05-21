<?php
// Démarrer la session
session_start();

// Définition des variables de session pour les catégories et les produits
$_SESSION['categories'] = array(
    '1' => array(
        'produit1' => array(
            'nom' => 'Nom du produit 1',
            'prix' => 10,
            'stock' => 5
        ),
        'produit2' => array(
            'nom' => 'Nom du produit 2',
            'prix' => 20,
            'stock' => 10
        )
    ),
    '2' => array(
        'produit3' => array(
            'nom' => 'Nom du produit 3',
            'prix' => 15,
            'stock' => 8
        ),
        'produit4' => array(
            'nom' => 'Nom du produit 4',
            'prix' => 25,
            'stock' => 12
        )
    ),
    '3' => array(
        'produit5' => array(
            'nom' => 'Nom du produit 5',
            'prix' => 30,
            'stock' => 6
        ),
        'produit6' => array(
            'nom' => 'Nom du produit 6',
            'prix' => 40,
            'stock' => 15
        )
    )
);

// Autres informations de session peuvent être définies ici

?>
