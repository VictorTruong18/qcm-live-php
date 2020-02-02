<?php 
// PAGE BILAN
ob_start(); 
require('./model/sessionBD.php');
require('./model/etudiantBD.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title> Bilan des étudiants </title>
	<meta charset="utf-8">

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

	<!-- Page content holder -->
	<section id="content"> 
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
									Tableau de Bord
									
								</a>
								<a href="#" class="nav-link px-4 rounded-pill">
									<i class="fas fa-chart-pie mr-2"></i>
									Statistiques
									
								</a>
								<a href="./index.php?action=logout" class="nav-link px-4 rounded-pill">
									<i class="fas fa-power-off mr-2"></i>
									Deconnexion
									
								</a>
								
								<a href="#" class="nav-link px-4 rounded-pill">
									<i class="fas fa-th-large mr-2"></i>
									Envoyer un commentaire
								</a>
							</div>   
						</nav>
						<!-- End -->

					</div>

					
					<div class="col-lg-8 mb-5">
						<!-- Demo Content-->
						<div class="p-5 bg-white d-flex align-items-center shadow-sm rounded h-100">
							<div class="demo-content">                
								<div id="infos">
									<!-- DONNEES -->
									<h1 class="badge-default infos"> Test : <?= $_SESSION['test']['titre']." ".$_SESSION['test']['id']?> </h1>
									<h1 class="badge-primary infos"> Professeur : <?= strtoupper($_SESSION['profil']['nom'])." ".$_SESSION['profil']['prenom'] ?> </h1>
									<h1 class="badge-dark infos"> Groupe : <?= $_SESSION['test']['numGrpe'].' ('.getEtudiantsFromGroupe($_SESSION['test']['numGrpe'])->rowCount().' etudiants)' ?> </h1>
									
									<h1 class="badge-info infos"> Bilan : Questions </h1> 
								</div>  

								<br>
								
								<table class="table">
								  <thead class="thead-dark">
								    <tr>
								      <th scope="col">ID Etudiant</th>
								      <th scope="col">Nom Prénom</th>
								      <?php 
								      	$nbQuestions = nbQuestion($_SESSION['test']['id']);
								      	for($i = 1; $i <= $nbQuestions; $i++) {
								      		echo '<th scope="col">Q'.$i.'</th>';
								      	}
								      ?> 
								      <th scope="col">Note /20</th>
								    </tr>
								  </thead>
								  <tbody>
								  	<?php 
								  		$etudiants = getEtudiantsFromGroupe($_SESSION['test']['numGrpe']);
								  		require_once('./controller/etudiant.php');

								  		while ($row = $etudiants->fetch()) {
								  			echo '<tr>
								      <th scope="row">'.$row['id_etu'].'</th>
								      <td>'.$row['nom'].' '.$row['prenom'].'</td>';
								   		
								      	$nbQuestions = nbQuestion($_SESSION['test']['id']);
								      	for($i = 1; $i <= $nbQuestions; $i++) {
								      		echo '<th scope="col"></th>';
								      	}
								       
								      echo '<td>'.getNote($row['id_etu']).'</td>
								    			 </tr>';
								  		}
								  	?>
								  	
								   </tbody>
								</table>
								

								<form action="" method="POST">
									<input type="submit" name="stop" value="EXPORTER"> 
								</form>

								<hr>
								<!-- ACCEDER AU BILAN -->
								<form action="./index.php?action=stopTest" method="POST">
									<input type="submit" name="stop" value="STOP"> 
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
require 'template.php'; 	