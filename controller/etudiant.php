<?php
// FONCTIONS CONCERNANT UN ETUDIANT

// CONNEXION A LA SESSION EN COURS 
// @param : titre du test
function joinSession() {
	$titreTest = isset($_POST['test'])?($_POST['test']):'';

	if(!verif_test($titreTest)) {
		$url = "index.php?action=tableauDeBord";
		header("Location:" .$url);
	}
	else {
		// VARIABLES SESSION
		require_once("./model/getters.php");
		$resultat = getDatasFromTestName($titreTest);	
	    
	    $titreT = htmlentities($titreTest, ENT_QUOTES, "UTF-8"); //permet de protéger tout les caractères spéciaux

		$_SESSION['test']['titre'] = $titreT;
	    $_SESSION['test']['id'] = $resultat['id_test'];
	    $_SESSION['test']['idProf'] = $resultat['id_prof'];
	    $_SESSION['test']['numGrpe'] = $resultat['num_grpe'];
	    $_SESSION['test']['date'] = $resultat['date_test'];
	    $_SESSION['test']['bActif'] = $resultat['bActif'];

	    // REDIRECTION 
		$url = "index.php?action=afficherTest";
		header("Location:" .$url);
	}
}

// VERIFICATION SESSION EN COURS
// @param : titre du test
function verif_test($titreTest) {
	require('./model/sessionBD.php');
	return verif_test_available($titreTest);
}

// QUESTIONS AUTORISEES A ETRE AFFICHE PAR LE PROFESSEUR DURANT LE TEST
function questionsAffichables() {
	require('./model/etudiantBD.php');
	return getQuestionsAffichables();
}

// ENREGISTRER LES REPONSES DE L'ETUDIANT
// @param : tableau de réponses
function enregistrerReponse(){
	$reponses = isset($_POST['reponse'])?($_POST['reponse']):'';
	
	foreach ($reponses as $id_rep) {
		require_once('./model/etudiantBD.php');
		enregistrerReponseBD($id_rep);	
	}

	// REDIRECTION 
	$url = "index.php?action=afficherTest";
	header("Location:" .$url);
}

// RETOURNE LA LISTE DES REPONSES D'UNE QUESTION
function listReponses($id_quest) {
	require_once('./model/getters.php');
	return getReponses($id_quest);
}

// RETOURNE VRAI SI LA REPONSE EST CHECKED
function isResponseChecked($id_quest, $id_u, $id_test, $id_rep) {
	require_once('./model/etudiantBD.php');
	return isChecked($id_quest, $id_u, $id_test, $id_rep);
}

// RETOURNE VRAI SI LA REPONSE EST COCHEE
function isResponseAnswered($id_quest, $id_u, $id_test) {
	require_once('./model/etudiantBD.php');
	return isAnswered($id_quest, $id_u, $id_test);
}

function getNote($id_etu) {
	require_once('./model/etudiantBD.php');
	require_once('./model/sessionBD.php');
	if(numberGoodAnswers($id_etu) == 0 ) {
		return 0;
	}
	else {
		return numberGoodAnswers($id_etu)*20/nbQuestion($_SESSION['test']['id']);
	}
}

// RETOURNE VRAI SI LA REPONSE EST COCHEE
function commentaire() {
	require_once('./view/commentaireView.php');
}

