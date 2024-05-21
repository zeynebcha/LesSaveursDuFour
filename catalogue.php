<?php 
    //session_start();
    //error_reporting(0);
?>

<?php include 'header.php'; ?>

<div id="Page">

    <?php
        $C = $_GET['cat'];
        $cat = (int)$C;
        echo '<h4 id="titre" class="cat">', $categories->categorie[$cat]->nom, "</h4>";
    ?>
    
    <table border="1">
        <thead>
            <tr> 
                <td>Nom</td> 
                <td>Photo</td> 
                <td>Ref</td>
                <td>Description</td>
                <td>Prix</td> 
                <td>Achat</td> 
                <?php if ($_SESSION['statut'] == 5): ?> <!-- Afficher les actions uniquement pour l'administrateur --> 
                <td>Stock</td>
                <td>Actions</td> 
                <?php endif; ?> 
            </tr>
        </thead>
        <tbody>
            <?php
                $C = $_GET['cat'];
                $cat = (int)$C;
                if (($handle = fopen("./data/catalogue.csv", "r")) !== FALSE):
                    $i = 0; 
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE):
                        if($i > 0){
                            if($data[1] == $cat){
                                if ($data[5] != 0){
                                    echo '<form method="post" action="recupProduit.php">',
                                         '<input type="hidden" name="cat" value="', $cat, '">',
                                         '<tr><td id="produit">',$data[0], //case nom du produit
                                         '<input type="hidden" name="nom" value="', $data[0], '">',
                                         '</td><td><div class="zoom"><p><img class="catalogue" src="./img/', $data[6], '">', // photo du produit 
                                         '<input type="hidden" name="img" value="', $data[6], '">',
                                         "</p></div></td><td>",$data[4], // ref 
                                         '<input type="hidden" name="ref" value="', $data[4], '">',
                                         "</td><td>",$data[2], //  descriptif 
                                         "</td><td>",$data[3],"€", // prix 
                                         '<input type="hidden" name="prix" value="', $data[3], '">',
                                         '</td><td> <input type="number" pattern="[0-9]" name="qte" id="qte" min="0" max="',$data[5],'"><br> ', // case Achat
                                         '<script type="text/javascript" src="stock.js"></script> <button type="submit" id="ajouter" name="ajouter" onclick="MAJstock()" >Ajouter au panier</button><br> </form>';
                                    
                                    // Code pour la gestion du stock
                                    if ($_SESSION['statut'] == 5) { // pour que seul l'administrateur voit 
                                        echo '</td><td>';
                                        echo '<button type="button" id="stock'.$i.'" onclick="toggle_text('.$i.');">Stock</button>';
                                        echo '<div id="st'.$i.'" style="display:none;">'.$data[5].'</div>';
                                        echo '<script>
                                            function toggle_text(i) {
                                                var col = document.getElementById("st"+i);
                                                if(col.style.display == "none") {
                                                    col.style.display = "block";
                                                } else {
                                                    col.style.display = "none";
                                                }
                                            }
                                            </script>';
                                        echo '</td><td>';
                                        echo '<a href="editerProduit.php?ref=', $data[4], '">Editer</a>';
                                        echo'<br><br>';
                                        echo '<a href="supprimerProduit.php?ref=', $data[4], '">Supprimer</a>';
                                        echo '</td>';
                                    }
                                    echo "</tr>";
                                }
                            }
                            $i++;
                        } else {
                            $i++;
                        }
                    endwhile;
                    fclose($handle);
                endif;
            ?>
        </tbody>
    </table>
</div>
	
    <?php include 'footer.php'; ?>
</body>
</html>
