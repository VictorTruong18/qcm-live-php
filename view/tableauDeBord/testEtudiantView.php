<?php 
// PAGE DE SESSION ETUDIANT
ob_start(); 
require_once('./controller/etudiant.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Etudiant, réponds juste aux questions</title>
	
	<!--Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,900|Ubuntu" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
	<!--CCS Stylsheet-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="./public/css/dashboard.css">
	<link rel="stylesheet" href="./public/css/mdb.min.css">
	<!--Font Awesome-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	
	<!-- SCRIPTS -->
	<script src="./public/js/app.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>  
</head>

<body>
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
										<p class="font-weight-light text-muted mb-0"><?php echo $_SESSION['profil']['nom'] . ' '. $_SESSION['profil']['num_grpe']?></p>
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
								<a href="./index.php?ation=logout" class="nav-link px-4 rounded-pill">
									<i class="fas fa-power-off mr-2"></i>
									Deconnexion
								</a>
								
				                <a href="./index.php?action=commentaire" class="nav-link px-4 rounded-pill">
				                  <i class="fas fa-robot mr-2"></i>
				                  Envoyer un commentaire  
				                </a>
							</div>
						</nav>
						<!-- End -->
					</div>
					<!-- FIN SIDE MENU PROF-->

					<!-- RECTANGLE BLANC ZONE POUR AFFICHER LE CONTENU -->
					<div class="col-lg-8 mb-5">
						<!-- Demo Content-->
						<div class="p-5 bg-white d-flex align-items-center shadow-sm rounded h-100">
							<div class="demo-content">
								<!-- TEMPLATE QUESTIONS A UTILISER POUR LES QUESTIONS -->
								<ul class="quiz">
									<fieldset>
										<legend>Questions</legend>
										<?php
										$questionsAffichables = questionsAffichables();
										$nbQuestions = 1;
										$nbReponses = 1;

												// POUR CHAQUE QUESTION
										foreach ($questionsAffichables as $valeur) {
													// TYPE PAR DEFAUT 
											$typeReponse = 'Radio';
											
													// NUMERO QUESTION 
											echo "<div class='form-group'>";
											echo '<form action="./index.php?action=enregistrerReponse" method="post">';
											echo "<p>" . $nbQuestions . " : " ;

													// SI MULTIPLE 
											if($valeur['bmultiple'] == 1){
												echo " multiple ";
												$typeReponse = 'Checkbox';
											} 

													// LA QUESTION 
											echo $valeur['titre'] ." : " . $valeur['texte'] . "</p>";

											$nbQuestions++;

											$reponses = listReponses($valeur['id_quest']);

													// LES REPONSES
											foreach ($reponses as $reponse) {
												echo "<div class='custom-control custom-".strtolower($typeReponse)."'>";

												echo "<p> <input type='".strtolower($typeReponse)."' name='reponse[]' value='".$reponse['id_rep']."' class='custom-control-input' ";

														// STYLE TEMPLATE
												if($typeReponse == 'Checkbox') {
													echo "id='customCheckbox".$nbReponses."'";
												}
												if($typeReponse == 'Radio') {
													echo "id='customRadio".$nbReponses."'";
												}

														// CHECKED OR DISABLED
												/* A CORRIGER */
												require_once('./model/etudiantBD.php');
												if(isResponseAnswered($valeur['id_quest'], $_SESSION['profil']['id'], $_SESSION['test']['id'])) {
													echo " disabled";
												}
												if(isResponseChecked($valeur['id_quest'], $_SESSION['profil']['id'], $_SESSION['test']['id'], $reponse['id_rep'])) {
													echo " checked";
												}
												
												echo "> <label class='custom-control-label' for='custom".$typeReponse.$nbReponses."'>".$reponse['texte_rep']."</label> </p> </div>";
												
												$nbReponses++;
											}
											echo "<input type=submit name='submit' ";
											if (isAnswered($valeur['id_quest'], $_SESSION['profil']['id'], $_SESSION['test']['id'])) {
												echo "disabled";
											} 
											echo ">";
											echo "</form></div>";
										}
										?>
									</fieldset>
								</ul>
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


