<?php 
// PAGE D'IDENTIFICATION 
ob_start(); 
?>

<!DOCTYPE html>
<html>
<head>
  <title> Identifies-toi bonhomme</title>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <!-- SCRIPTS -->
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="./public/css/login.css">
</head>
<!------ Include the above in your HEAD tag ---------->

<body>
  <div class="wrapper fadeInDown"style="background-color: #5c94bd;">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <h1>  </h1>
      </div>

      <!-- Login Form -->
      <form action="./index.php?action=register" method="post">
      <p class="h4 mb-4 underlineHover"style="font-family:'Noto Sans',sans-serif;">QCM Live</p>
       <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked="">
              <label class="custom-control-label" for="customRadio1"> Etudiant </label>
            </div>
        </div>
      <div class="form-check form-check-inline">
            <div class="custom-control custom-radio">
              <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio2">Professeur </label>
            </div>
      </div>
        <input type="text" id ="nom" class="fadeIn fourth" name="nom_utilisateur"placeholder="Nom"required>
        <input type="text" id ="prenom" class="fadeIn fith" name="prenom_utilisateur"placeholder="Prénom"required>
        <input type="text" id ="mail" class="fadeIn sixth" name="mail_utilisateur"placeholder="Adresse mail"required>
        <input type="text" id="login" class="fadeIn second" name="login_utilisateur" placeholder="Identifiant"required>
        <input type="text" id="groupe" class="fadeIn second" name="groupe_utilisateur" placeholder="groupe (si étudiant)">
        <input type="password" id="password" class="fadeIn third" name="pass_utilisateur" placeholder="Mot de passe"required>
        <input type="submit" class="fadeIn seventh" value="S'inscrire">
      </form>

      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="#">Vous possédez déjà un compte? Connectez-vous !</a>
      </div>

    </div> 
  </div>
  <hr>
</body>

</html>

<?php
$contenu = ob_get_clean(); 
require 'template.php';
