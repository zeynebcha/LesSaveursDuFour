<?php  // verification du formulaire en php 
    session_start();
    error_reporting(0);
   @$nom=$_POST["nom"];
   @$prenom=$_POST["prenom"];
   
   @$email=$_POST["email"];
   @$object=$_POST["object"];
   @$contenu=$_POST["contenu"];
   @$genre=$POST["genre"];
   @$date_naissance=$POST["date_naissance"];
   @$valider=$_POST["valider"];
   
   
   if(isset($valider)){ 
      if(empty($nom))
         $message='<div class="erreur">Nom laissé vide.</div>';
      elseif(empty($prenom)) // Si le prenom n'est pas rempli ca renvoie un message d'erreur
         $message='<div class="erreur">Prénom laissé vide.</div>';
      elseif(empty($email))
         $message='<div class="erreur">email laissé vide.</div>';
      elseif(empty($object))
         $message='<div class="erreur">Objet laissé vide.</div>';
     elseif(empty($contenu))
         $message='<div class="erreur">Contenu laissé vide.</div>';      
      else{
        $message.='<div class="succes">Formulaire soumis avec succès.</div>';
      }
   }
   
?>

<!DOCTYPE html>
<html> 
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> Les Saveurs du Four Contact </title>
      <link rel="icon" type="image/png" href="img/logo.png">
      <link rel="stylesheet" href="./css/index.css">
        
        <script >
  
            function validateForm()    // permet d'ecrire en rouge si un champs n'est pas correctement remplis  ( enlever les required pour l'utiliser)                          
            { 
                var name = document.forms["myForm"]["name"];
                var prenom = document.forms["myForm"]["prenom"]; 
                var email = document.forms["myForm"]["email"];     
                var object = document.forms["myForm"]["object"];     
                var contenu = document.forms["myForm"]["contenu"];     

                if (name.value == "" ) { 
                    document.getElementById('errorname').innerHTML="Veuillez entrez un nom valide"; 
                    name.focus(); 
                    return false; 
                }
                if (prenom.value == ""){ 
                    document.getElementById('errorprenom').innerHTML="Veuillez entrez un prenom valide";  
                    prenom.focus(); 
                    return false; 
                }

                if (email.value == ""){ 
                    document.getElementById('erroremail').innerHTML="Veuillez entrez un email valide";  
                    email.focus(); 
                    return false; 
                }

                if (object.value == ""){ 
                    document.getElementById('errorobject').innerHTML="Veuillez entrez Un intitulé a votre message ";  
                    object.focus(); 
                    return false; 
                }

                if (contenu.value == ""){ 
                    document.getElementById('errorcontenu').innerHTML="Veuillez entrez un Message";  
                    contenu.focus(); 
                    return false; 
                }


                else{
                    document.getElementById('errorname').innerHTML="";  
                    document.getElementById('errorprenom').innerHTML="";  
                    document.getElementById('erroremail').innerHTML="";
                    document.getElementById('errorobject').innerHTML="";
                    document.getElementById('errorcontenu').innerHTML=""; 
                }
            }

        </script>        
    </head>
  

 
    <?php include 'header.php'; ?>

  
            <h1 > Contact </h1>

                <?php echo $message ?>
                <form name="myForm" method="post" action="send_email.php" onsubmit = "return validateForm()"> <!-- Creation du formulaire -->
                

                    <div class="champ">Date du jour</div>
                            <!-- Permet de donner la date du jour -->
                            <script>
                                date = new Date().toLocaleDateString();
                                document.write(date);
                                </script>

                        <div class="label">Nom</div>
                        <div class="champ">
                        <input type="text" name="nom" pattern="^[A-Za-z '-]+$" maxlength="30" value="<?php echo $nom?>" required />
                        <span class="error" id="errorname"></span>
                        </div>

                                          
                        <div class="label">Prénom</div>
                        <div class="champ">
                        <input type="text" name="prenom" pattern="^[A-Za-z '-]+$" maxlength="30" value="<?php echo $prenom?>" required />
                        <span class="error" id="errorprenom"></span>
                        </div>

                        <div class="label">Email</div>
                        <div class="champ">
                        <input type="text" name="email" value="<?php echo $email?>" required />
                        <span class="error" id="erroremail"></span>
                        </div>

                        <div class="label">Genre</div>
                        <div class="champ" value="<?php echo $genre?>" required>
                                <input type="radio" id="Homme" name="genre" />
                                <label for="Homme">Homme</label>
                            
                                <input type="radio" id="Femme" name="genre" />
                                <label for="Femme">Femme</label>
                            </div>

                        <div class="label">Métier</div>
                        <div class="champ">
                            <select name="Métier" id="metier">
                                <option value="">Choisissez un métier</option>
                                <option value="Boulanger">Boulanger</option>
                                <option value="Cadre">Cadre</option>
                                <option value="Ouvrier">Ouvrier</option>
                                <option value="Cadre supérieur">Cadre supérieur</option>
                                <option value="Enseignant">Enseignant</option>  
                            </select>
                        </div>
                         
                        <div class="label">Date de naissance</div>
                            <div class="champ">
                                <input type="date" id="date_naissance" name="date_naissance" required>
                            </div>    




                        <div class="label">Objet</div>
                            <div class="champ">
                                <input type="text"  id="object" name="object" placeholder="Demande information" maxlength="40" required>
                                <span class="error" id="errorobject"></span>
                            </div>

                            <div class="label">Votre Message </div>
                            <div class="champ">
    
                                <textarea id="contenu" name="contenu" rows="4" cols="50"></textarea>
                                <span class="error" id="errorcontenu"></span>
                            </div>
                
                            <br> <br>
                        <div class="champ">
                        <input type="submit" name="valider" value="Envoyer" />
                        </div>
                    </form>
                        <br> <br>
        </div>
            
           

       <?php include 'footer.php'; ?>
    </body> 
</html>