<?php 
	session_start();
   
?>

   <?php
         if (isset($_SESSION['PanierRef'])) {

         $qte=$_POST['qte']; $ref=$_POST['ref'];$img=$_POST['img']; $prix=$_POST['prix']; $nom=$_POST['nom']; $cat=$_POST['cat'];
   
        array_push( $_SESSION['PanierRef'], $ref); 
        array_push( $_SESSION['PanierQte'], $qte);
        array_push( $_SESSION['PanierPrix'], $prix);
        array_push( $_SESSION['PanierImg'], $img); 
        array_push( $_SESSION['PanierNom'], $nom);
        array_push( $_SESSION['PanierCat'], $cat);
        echo'<script src="stock.js"></script>';

       } else { // si on a rien dans le panier 
        $_SESSION['PanierRef'] = array();
        $_SESSION['PanierQte'] = array(); 
        $_SESSION['PanierImg']= array(); 
        $_SESSION['PanierNom']=array();
        $_SESSION['PanierPrix']=array();
        $_SESSION['PanierCat']=array(); 
        
        $qte=$_POST['qte']; $ref=$_POST['ref'];$img=$_POST['img']; $prix=$_POST['prix']; $nom=$_POST['nom'];$cat=$_POST['cat'];
   
        array_push( $_SESSION['PanierRef'], $ref); 
        array_push( $_SESSION['PanierQte'], $qte);
        array_push( $_SESSION['PanierPrix'], $prix);
        array_push( $_SESSION['PanierImg'], $img); 
        array_push( $_SESSION['PanierNom'], $nom);
        array_push( $_SESSION['PanierCat'], $cat);
        
        

       }
       
    echo $nom." a bien été ajouté à votre panier !"; 
    echo '<a href="panier.php"> Voir mon panier <a>';
    echo '<a href="catalogue.php?cat=0"> Poursuivre mes achats <a>';
   
    ?>
