<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="path/to/index.css">

<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/formulaires-ajax.js"></script>

<div id="Page">
    <br>
    <form method="post" action="./php/action.php">
        <input type="hidden" name="action" value="inscription">
        Nom : <input type="text" id="nom" name="nom" placeholder="Nom" required="required" pattern="^[A-Za-z\p{L} '-]+$" maxlength="30"><br>
        Prénom : <input type="text" id="prénom" name="prénom" placeholder="Prénom" required="required" pattern="^[A-Za-z\p{L} '-]+$" maxlength="30"><br>
        Genre : <input type="radio" id="genre1" name="genre" value="Homme" checked>
                <label for="genre1">Homme</label>
                <input type="radio" id="genre2" name="genre" value="Femme">
                <label for="genre2">Femme</label><br>
        Adresse mail : <input type="email" name="email" placeholder="Adresse électronique" required="required"><br>
        Téléphone : <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="0x-xx-xx-xx-xx" required="required"><br>
        Date de naissance : <input type="date" name="date" min="1900-01-01" max="2006-01-01" placeholder="jj/mm/aaaa" required="required"><br>
        Adresse : <textarea name="adresse" id="adresse" required="required" maxlength="40"></textarea><br>
        Catégorie socio-professionnelle (métier) : <input type="text" name="metier" placeholder="Métier" required="required" pattern="^[A-Za-z\p{L}]+$" maxlength="20"><br><br>
        Nom d'utilisateur : <input type="text" id="pseudo" name="pseudo" placeholder="Nom d'utilisateur" required="required" pattern="^[A-Za-z]{1,}$" maxlength="20"><br>
        Mot de passe : <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" required="required" maxlength="20"><br>
        <input type="submit" id="submit" name="submit" value="M'inscrire">
    </form>
</div>

<?php include 'footer.php'; ?>
</body> 
</html>
