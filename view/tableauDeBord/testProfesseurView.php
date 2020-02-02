<?php 
// PAGE DE SESSION PROFESSEUR
ob_start();
require_once('./model/sessionBD.php'); 
require_once('./model/getters.php'); 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Professeur, ayez pitié des étudiants</title>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="./public/css/login.css">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,900|Ubuntu" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
  <!--CCS Stylsheet-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="./public/css/dashboard.css">
  <link rel="stylesheet" href="./public/css/mdb.min.css">
  <link rel="stylesheet" href="./public/css/input.css">    
  <!--Font Awesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <!-- SCRIPTS -->
  <script src="./public/js/app.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh1IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body>
  <section id="content" > 
    <div class="container-fluid px-md-5">    
      <div class="rounded">
        <div class="row">
          <div class="col-lg-4 mb-4 mb-lg-0">
            <!-- Vertical Menu-->
            <nav class="nav flex-column bg-white shadow-sm font-italic rounded p-3 sticky">
              <div class="py-4 px-3 mb-4 bg-light">
                <div class="media d-flex align-items-center"><img src="./public/images/img0.png" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                  <div class="media-body">
                    <h4 class="m-0"></h4>
                    <p class="font-weight-light text-muted mb-0"><?php echo $_SESSION['profil']['nom'] . ' '. $_SESSION['profil']['prenom']?></p>
                  </div>
                </div>  

                <a href="./index.php?action=tableauDeBord" class="nav-link px-4 active rounded-pill">
                 <i class="fas fa-home mr-2"></i>
                 Carnet de bord

               </a>
               <a href="./index.php?action=statistiques" class="nav-link px-4 rounded-pill">
                 <i class="fas fa-chart-pie mr-2"></i>
                 Statistiques

               </a>
               <a href="#" class="nav-link px-4 rounded-pill">
                 <i class="fas fa-th-large mr-2"></i>
                 Editer Tests
               </a>

               <a href="./index.php?action=logout" class="nav-link px-4 rounded-pill">
                 <i class="fas fa-power-off mr-2"></i>
                 Deconnexion
               </a>

             </div>
           </nav>
         </div>

         <div class="col-lg-8 mb-5">
          <!-- Demo Content-->
          <div class="p-5 bg-white d-flex align-items-center shadow-sm rounded h-100">
            <div class="demo-content">   
              <!-- <p> Thème : <?= $_SESSION['test']['theme'] ?> </p> -->
              <div id="infos">
                <!-- DONNEES -->
                <h1 class="badge-default infos"> Test : <?= $_SESSION['test']['titre'] ?> </h1>
                <h1 class="badge-primary infos"> Professeur : <?= strtoupper($_SESSION['profil']['nom'])." ".$_SESSION['profil']['prenom'] ?> </h1>
                <h1 class="badge-dark infos"> Groupe : <?= $_SESSION['test']['numGrpe'] ?> </h1>

                <h1 class="badge-info infos"> Bilan : Questions </h1> 
              </div>  
              <hr>

              <h3> Questions : </h1>

                <!-- AFFICHER QUESTIONS A COCHER POUR AFFICHER -->
                <form action='./index.php?action=setQuestionsAffichables' method='POST'>
                  <?php
                  $nbQuestion = 1;
                  $resultat = getQuestions();
                  while($row = $resultat->fetch()) {
                    echo "<p> <fieldset>";
                    if($row['bmultiple'] == 1){
                      $mult = "multiple";
                    }
                    else {
                      $mult = "";
                    }

                    echo "<input type='checkbox' name='question[]' id='question" . $nbQuestion . "' value='". $row['titre'] . "'";
                    if(isAffichable($row['id_quest'], $_SESSION['test']['id'])){
                      echo " checked='checked' disabled";
                    }
                    echo "> ";
                    echo  "<label class='" . $mult . "' for='question" . $nbQuestion .  "'>-" . $nbQuestion . "-  " . $row['titre'] ." : " . $row['texte'];
                    echo "</label></fieldset></p>";

                    $nbQuestion++;
                  }
                  ?>

                  <input type="submit" value="Afficher les Questions">
                </form>

                <!-- LISTE DES ETUDIANTS CONNECTES -->
                <?php
                $etudiants = getConnectedEtudiants($_SESSION['test']['numGrpe']);
                if (empty($etudiants->rowCount())) {
                  echo "Aucun étudiant encore connecté...";
                }
                else {
                  echo "Liste des étudiants connectés : ";
                  foreach ($etudiants as $etudiant) {
                    echo "<p> Nom : ". $etudiant['nom'] ." Prenom : " . $etudiant['prenom'];
                    require_once('./model/etudiantBD.php');
                    echo ", Nombre bonnes réponses : " . numberGoodAnswers($etudiant['id_etu']);
                    echo "</p>";
                  } 
                }
                ?>

                <hr> 

                <!-- ACCEDER AU BILAN -->
                <form action="./index.php?action=bilan" method="POST">
                  <input type="submit" name="stop" value="BILAN"> 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>

<?php 
$contenu = ob_get_clean(); 
require './view/template.php';
