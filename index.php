<?php include 'header.php'; 
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Les Saveurs du Four</title>
        <link rel="icon" type="image/png" href="./img/logo.png">
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="./css/catalogue.css"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>  
    <body>
        <header>
            <img src="./img/header.jpg">
            <h1>Les Saveurs du Four,</h1>
            <h4>A CHACUN SON MOMENT DE GOURMANDISE.</h4>
            <a href="catalogue.php?cat=0"><button>La carte</button></a> 
        </header>
        <section class="section-text">
            <h1>Notre Boulangerie</h1>
            <p>
                Découvrez un monde où la magie du four rencontre l'art de la boulangerie. Chez "Les Saveurs du Four", chaque bouchée raconte une histoire de tradition et de passion. Nos pains croustillants et nos pâtisseries exquises sont le fruit d'un savoir-faire ancestral, transmis avec passion de génération en génération. Venez goûter à l'authenticité de nos créations, où chaque bouchée raconte une histoire de saveurs inoubliables. Entrez dans notre univers gourmand et laissez-vous emporter par une expérience de plaisir gustatif.
            <br><br>
            </p>
            <img src="./img/bg.jpg">
        </section>
    <!-- Nouvelle section de savoir-faire -->
        <section class="section-background">
            <div class="presentation">
                <div class="image-container">
                    <img src="./img/savoirfaire.jpg" alt="Pâtisserie">
                </div>
                <div class="text-container">
                    <h2>Notre Savoir-Faire</h2>
                    <p>
                        Farine, eau, sel de mer et levure : quatre ingrédients simples qui, lorsqu'ils sont mélangés, façonnés, fermentés et cuits, constituent l'un des aliments les plus fondamentaux qui ont nourri les humains pendant des milliers d'années. Puisqu'il y a si peu d'ingrédients en jeu, deux choses distinguent un bon pain : des ingrédients de qualité et du temps.
                    </p>
                </div>
            </div>
        </section>
        <!-- Nouvelle section de services-->
        <section class="section-background=">
            <div class="presentation">
                <div class="image-container">
                    <img src="./img/services.jpg" alt="Pâtisserie">
                </div>
                <div class="text-container">
                    <h2>Nos Services</h2>
                    <p>
                        Découvrez nos services personnalisés, de la commande en ligne à la livraison à domicile. Nous sommes là pour rendre votre expérience chez 'Les Saveurs du Four' aussi pratique et agréable que possible.
                    </p>
                </div>
            </div>
        </section>
        <!-- Nouvelle section de produits -->
        <section class="section-products">
            <h2>Nos Produits</h2>
            <p>
                Explorez notre délicieuse sélection de pains frais, de pâtisseries exquises et de gourmandises artisanales. Chaque produit est préparé avec les meilleurs ingrédients pour vous offrir une expérience gustative inoubliable.
            </p>
            <div class="product-grid">
                <div class="product-item">
                    <img src="./img/pains.jpg" alt="Nos Pains">
                    <h3><a href="./catalogue.php?cat=0">Nos pains</a></h3>
                </div>
                <div class="product-item">
                    <img src="./img/viennoiseries.jpg" alt="Nos Viennoiseries">
                    <h3><a href="./catalogue.php?cat=1">Nos Viennoiseries</a></h3>
                </div>
                <div class="product-item">
                    <img src="./img/patisseries.jpg" alt="Nos Pâtisseries">
                    <h3><a href="./catalogue.php?cat=1">Nos Pâtisseries</a></h3>
                </div>
            </div>
            <a href="./carte.php" class="view-products-button">Voir les Produits</a>
        </section>
        <img src="./img/foot.jpg" >
        
        <?php include 'footer.php'; ?>
        
            
        
    </body>
</html>