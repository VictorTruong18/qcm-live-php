<?php 
// FONCTIONS CONCERNANT UN UTILISATEUR 

// IDENTIFICATION A LA BASE DE DONNEES
function ident() {
	$login_utilisateur = isset($_POST['login_utilisateur'])?($_POST['login_utilisateur']):'';
	$pass_utilisateur = isset($_POST['pass_utilisateur'])?(sha1($_POST['pass_utilisateur'])):'';
	$type_utilisateur = isset($_POST['type_utilisateur'])?($_POST['type_utilisateur']):'';

	require ('./model/utilisateurBD.php');
	// VERIFICATION IDENTIFICATION
    if  (!verif_ident_BD($login_utilisateur,$pass_utilisateur,$type_utilisateur)) {
		$url = "index.php?action=login&type_utilisateur=" .$type_utilisateur;
		header("Location:" .$url);	
	}
    else {		
    	$url = "index.php?action=tableauDeBord";
		header("Location:" .$url);
    }
}

function logout() {
	require('./model/finSession.php');
	$url = "index.php";
	header("Location:" .$url);	
}

// REDIRIGE VERS LE TABLEAU DE BORD DE L'UTILISATEUR
function tableauDeBord() {
	if(isset($_SESSION['profil']['typeU'])) {
		if($_SESSION['profil']['typeU'] == 'etudiant'){
			require('./view/tableauDeBord/etudiantView.php');
		}
		if($_SESSION['profil']['typeU'] == 'professeur'){
			require('./view/tableauDeBord/professeurView.php');
		}
	}
}

// REDIRIGE VERS LE TEST DE L'UTILISATEUR
function afficherTest() {
	if(isset($_SESSION['profil']['typeU'])) {
		if($_SESSION['profil']['typeU'] == 'etudiant'){
			require('./view/tableauDeBord/testEtudiantView.php');
		}
		if($_SESSION['profil']['typeU'] == 'professeur'){
			require('./view/tableauDeBord/testProfesseurView.php');
		}
	}
}

// PAGE STATISTIQUES
function statistiques() {
	if(isset($_SESSION['profil']['typeU'])) {
		if($_SESSION['profil']['typeU'] == 'etudiant'){
			require('./view/statistiques/etudiantStat.php');
		}
		if($_SESSION['profil']['typeU'] == 'professeur'){
			require('./view/statistiques/professeurStat.php');
		}
	}
}

// AUTRES PAGES 
function index() {
	require('./view/indexView.php');
}

// ACCEDE AU PAGES UTILISATION
function pageUtilisation1() {
	require('./view/utilisation/utilisationView1.php');	
}

function pageUtilisation2() {
	require('./view/utilisation/utilisationView2.php');	
}

function pageUtilisation3() {
	require('./view/utilisation/utilisationView3.php');	
}

// PAGE DEVELOPPEURS
function pageDeveloppeurs() {
	require('./view/developpeursView.php');
}

// PAGE LOGIN
function login() {
	require('./view/loginView.php');
}

// PAGE REGISTER
function register() {
	require('./view/registerView.php');
}



