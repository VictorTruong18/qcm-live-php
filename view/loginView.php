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
      <form action="./index.php?action=ident" method="post">
        <p class="h4 mb-4 underlineHover"style="font-family:'Noto Sans',sans-serif;">QCM Live</p>
        <input type="text" id="login" class="fadeIn second" name="login_utilisateur" placeholder="identifiant"required>
        <input type="password" id="password" class="fadeIn third" name="pass_utilisateur" placeholder="mot de passe"required>
        <input type = "text" name="type_utilisateur" value="<?php echo $_GET['type_utilisateur']; ?>"placeholder="professeur ou etudiant"required>
        <input type="submit" class="fadeIn fourth" value="Se connecter">
      </form>

      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="#">Mot de passe oublié?</a><br>
        <a class="underlineHover" href="./index.php?action=register">Pas de compte? Inscrivez-vous !</a><br>
      </div>

    </div> 
  </div>
  <hr>
</body>

</html>

<?php
$contenu = ob_get_clean(); 
require 'template.php';
