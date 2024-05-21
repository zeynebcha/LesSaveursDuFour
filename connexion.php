<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="path/to/index.css">
        <div id="Page">
            <form method="post" action="php/action.php" >
            <input type="hidden" name="action" value="connexion">
                Nom d'utilisateur :  <input type="text" id="pseudo" name="pseudo" placeholder="Nom d'utilisateur" pattern="^[A-Za-z]{1,}+[0-9]{2,}+$" maxlength="20" required="required"><br>
                Mot de passe :  <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" maxlength="20" required="required"><br>
                <input type="submit" id="submit" name="name" value="Connexion" onclick="/php/action.php"> <br> <br>
            </form>
            <form id="inscription" action="inscription.php" method="get">
                <input type="submit" value="Inscription">
            </form>

        </div>
        
        <?php include 'footer.php'; ?>
    </body> 
</html>