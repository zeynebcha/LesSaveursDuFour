<!DOCTYPE html>
<html>

<head>
	<title> Les Saveurs du Four</title>
	<link rel="icon" type="../image/png" href="../img/logo.png">
	<link rel="stylesheet" href="./css/index.css">
	<link rel="stylesheet" href="./css/catalogue.css"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body >
    
    <!-- debut barre de navigation-->
    <nav>
        <img src="./img/logo.png" alt="logo" class="logo">
        <div class="onglets">
            <a href="./index.php">A propos</a>
            <?php 
            // pour automatiser l'affichage des catégories dans le menu
            $categories = simplexml_load_file("./data/categories.xml");
            for ($n = 0; $n < count($categories); $n++) {
                // affiche le lien vers la page categorie n
                echo '<a href="catalogue.php?cat=' . $n . '">' . $categories->categorie[$n]->nom . '</a>';
            }
            ?>
            <a href="./contact.php">Contact</a>
        </div>
      
        <div class="boutons">
            <?php 
                session_start();
                error_reporting(0);
                if ($_SESSION['statut'] == 3) { // valeur par défaut
                    $_SESSION['statut'] = 0; // statut non connecté
                }
                if ($_SESSION['statut'] == 0) {
                    echo '<button class="login"><a href="connexion.php">Connexion</a></button>';
                } else {
                    echo '<button class="login"><a href="../php/deconnexion.php">Deconnexion</a></button>';
                }
            ?>
            <div class="boutonRose">
                <a href="panier.php"> Panier </a>
                <div class="box">
                    <iframe src="prevupanier.php" width="150px" height="150px"></iframe>
                </div>
                <img src="./img/panier.png" alt="panier" id="panier">
            </div>
            
        </div>

    </nav>
    <!--fin barre de navigation-->
</body>

</html>




