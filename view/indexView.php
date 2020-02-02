<?php 
// PAGE D'ACCUEIL 
ob_start(); 
?>

<!DOCTYPE html>
<html>

<head>
  <title> QCM Live, exercez-vous en direct</title>
  <meta charset="utf-8">

  <!--Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,900|Ubuntu" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
  <!--CCS Stylsheet-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="./public/css/indexView.css">
  <link rel="stylesheet" href="./public/css/mdb.min.css">
  <!--Font Awesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <!-- SCRIPTS -->
  <script src="./public/js/app.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script> new WOW().init();
  $( ".wow" ).addClass( "fadeInUp" );
  </script>


</head>

<section id ="intro">
  <div class="row">
    <div class="col-lg-6">
      <img class="title-image wow fadeInDown" src="./public/images/img0.png" alt="">
    </div>

    <div class="col-lg-6">
      <h1 class="wow fadeInRight"> Plus d'intéractivité avec vos étudiants grâce à<br> Qcm Live.</h1>

      <?php
        // SI UN UTILISATEUR EST CONNECTE : AFFICHE SEULEMENT TABLEAU DE BORD
        // SINON AFFICHE BOUTONS PROFESSEUR OU ETUDIANT
      if(isset($_SESSION['profil'])){
        echo '<a href="./index.php?action=tableauDeBord">';
        echo '<button type="button"   class="btn btn-dark btn-lg download-button">
        <i class="fas fa-chalkboard-teacher"></i> Tableau de Bord
        </button>
        </a>';
      }
      else {
        echo '<a href="./index.php?action=login&type_utilisateur=professeur">';
        echo '<button type="button"   class="btn btn-dark btn-lg download-button">
        <i class="fas fa-chalkboard-teacher"></i> Professeur
        </button>
        </a>';
        echo '<a href="./index.php?action=login&type_utilisateur=etudiant">';
        echo '<button type="button"   class="btn btn-outline-light btn-lg download-button">
        <i class="fas fa-user-graduate"></i> Etudiant
        </button>
        </a>';        
      }
      ?>
    </div>
  </div>  
</section>


<!-- Features -->

<section id="features">
  <div class="row">
    <div class="feature-box col-lg-4 col-md-12 col-sm-12">
      <i class="icon fas fa-check-circle fa-4x wow fadeIn" data-wow-delay="0.5s"> </i>
      <h3 class="font-weight-bold text-center"style ="font-family:'Noto Sans', sans-serif;">Facile à utiliser. </h3>
      <p class="text-center"style ="font-family:'Noto Sans', sans-serif;">Un outil à la portée de tous. </p>
    </div>
    <div class="feature-box col-lg-4 col-md-12 col-sm-12 ">
      <i class="icon fas fa-bullseye fa-4x animated wow fadeIn"data-wow-delay="0.5s"></i>
      <h3 class="font-weight-bold text-center"style ="font-family:'Noto Sans', sans-serif;">Le meilleur sur le marché.</h3>
      <p class="text-center"style ="font-family:'Noto Sans', sans-serif;">Pas plus rapide et ergonome.</p>
    </div>
    <div class="feature-box col-lg-4 col-md-12 col-sm-12">
      <i class="icon fas fa-heart fa-4x animated wow fadeIn" data-wow-delay="0.5s"></i>
      <h3 class="font-weight-bold text-center"style ="font-family:'Noto Sans', sans-serif;">Codé avec attention.</h3>
      <p class="text-center"style ="font-family:'Noto Sans', sans-serif;">Une équipe de développeurs passionnés.</p>
    </div>
  </div>
  
</section>
<a id="back-to-top" href="#" class="btn btn-blue-gradient btn-lg back-to-top"role="button"><i class="fas fa-chevron-up"></i></a>

<?php 
$contenu = ob_get_clean(); 
require 'template.php'; 

