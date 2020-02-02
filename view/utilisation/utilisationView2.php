<?php 
// PAGE UTILISATION 2
ob_start(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Utilisation</title>
	<meta charset="utf-8">
	<!--Google Fonts -->
	
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:300&display=swap" rel="stylesheet">
	<!--CCS Stylsheet-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="./public/css/utilisationView.css">
	<link rel="stylesheet" href="./public/css/mdb.min.css">
	<!--Font Awesome-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script> new WOW().init();</script>
</head>
<!-- Page Content -->
<section id="tuto">   
	<div class="container">
		<div class="jumbotron wow bounceInDown"style="background-color:#F0F1F7">
			<div class="container">
				<h2 class="display-4">Tutoriel d'utilisation</h2>
				<p class="lead">Prenez le temps de comprendre.<br><strong><u>En tant qu'étudiant.</strong></u></p>
			</div>
		</div>


		<!-- Project One -->
		<div class="row">
			<div class="col-md-7">
				<a href="#">
					<img class="img-fluid rounded mb-3 mb-md-0 wow fadeIn" src="./public/images/tuto1.jpg" alt="">
				</a>
			</div>
			<div class="col-md-5">
				<h3>Accueil</h3>
				<p>Un accueil chaleureux pour une personne en quête de connaissance ou de partage, où vous pouvez choisir votre rôle profil. Professeurs, prenez contrôle de vos QCMs en cliquant sur le bouton PROFESSEUR. Etudiants, allez vite rejoindre votre test avec le bouton ETUDIANT.</p>
				<a class="btn btn-primary" href="./index.php">Accueil</a>
			</div>
		</div>
		<!-- /.row -->

		<hr>

		<!-- Project Two -->
		<div class="row">
			<div class="col-md-7">
				<a href="#">
					<img class="img-fluid rounded mb-3 mb-md-0 wow fadeIn" src="./public/images/tuto2.jpg" alt="">
				</a>
			</div>
			<div class="col-md-5">
				<h3>Login</h3>
				<p>Entrez votre identifiant ainsi que votre mot de passe afin de pouvoir vous connecter et profiter d'une nouvelle expérience innovante pour vos cours d'amphithéatre.
					<strong>Attention à bien préciser si vous êtes un étudiant ou un professeur si vous appuyer sur le bouton connecter du menu.</strong></p>
					<a class="btn btn-primary" href="#">Se connecter</a>
				</div>
			</div>
			<!-- /.row -->

			<hr>
			<div class="row">
				<div class="col-md-7">
					<a href="#">
						<img class="img-fluid rounded mb-3 mb-md-0 wow fadeIn" src="./public/images/tuto4.jpg" alt=""><br><br>
						<img class="img-fluid rounded mb-3 mb-md-0 wow fadeIn" src="./public/images/question_etu.jpg" alt="">
					</a>
				</div>
				<div class="col-md-5">
					<h3>Menu</h3>
					<p>Grâce à notre User Experience, le menu a été élaboré afin que vous puissiez naviguer en toute sérénité dans un environnement épuré et simple.
						En tant qu'étudiant, vous pourrez rejoindre une session de test lancer par votre professeur en écrivant le nom du test. 
					</p>
					<br><br><br><br><br><br><h3>Questions</h3><p>Vous serez alors redirigés vers le test et pourrez répondre aux questions posés par votre professeur.</p>
				</div>
			</div>
			<hr>
			<!-- Project Three --> 
			<div class="row">
				<div class="col-md-7">
					<a href="#">
						<img class="img-fluid rounded mb-3 mb-md-0 wow fadeIn" src="./public/images/tuto3.jpg" alt="">
					</a>
				</div>
				<div class="col-md-5">
					<h3>Les Développeurs</h3>
					<p>Jetez un coup d'oeil à la page "LES DEVELOPPEURS" pour nous connaître un peu plus et partagez votre avis.</p>
					<a class="btn btn-primary" href="./index.php?action=developpeurs">Les Développeurs</a>
				</div>
			</div>
			<!-- /.row -->

			<hr>

			<!-- Pagination -->
			<nav aria-label="Page navigation example">
				<ul class="pagination pg-blue justify-content-center">
					<li class="page-item">
						<a class="page-link" href="./index?action=pageUtilisation1" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
							<span class="sr-only">Previous</span>
						</a>
					</li>
					<li class="page-item ">
						<a class="page-link" href="./index.php?action=pageUtilisation1">1</a>
					</li>
					<li class="page-item active">
						<a class="page-link" href="./index.php?action=pageUtilisation2">2</a>
					</li>
					<li class="page-item">
						<a class="page-link" href="./index.php?action=pageUtilisation3">3</a>
					</li>
					<li class="page-item">
						<a class="page-link" href="./index?action=pageUtilisation3" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
							<span class="sr-only">Next</span>
						</a>
					</li>
				</ul>
			</nav>
			<br>
		</div>
	</section>
</body>
</html>
		
<?php 
$contenu = ob_get_clean(); 
require './view/template.php';

