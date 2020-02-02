<?php 
// FONCTIONS CONCERNANT UN PROFESSEUR

// AJOUTE LES ELEMENTS DANS LA TABLE QCM POUR QUE LES ETUDIANTS PUISSENT VOIR LES QUESTIONS
// @param : Titre du test à démarrer
function startTest() {

	$titre_test = isset($_POST['titreTest'])?($_POST['titreTest']):'';

	// VARIABLES SESSIONS 	
	require_once("./model/getters.php");
	$resultat = getDatasFromTestName($titre_test);	
    
    $titreT = htmlentities($titre_test, ENT_QUOTES, "UTF-8"); //permet de protéger tout les caractères spéciaux

	$_SESSION['test']['titre'] = $titreT;
    $_SESSION['test']['id'] = $resultat['id_test'];
    $_SESSION['test']['idProf'] = $resultat['id_prof'];
    $_SESSION['test']['numGrpe'] = $resultat['num_grpe'];
    $_SESSION['test']['date'] = $resultat['date_test'];
    $_SESSION['test']['bActif'] = $resultat['bActif'];

    // CREER LES QUESTIONS DANS TABLE QCM
    require_once("./model/sessionBD.php");
    createQCMs($titre_test);

    // RENDRE TEST ACTIF 
    activateTest($_SESSION['test']['id']);

    // REDIRECTION
	$url = "index.php?action=afficherTest";
    header("Location:" .$url);
}

// CONTINUER LE TEST EN COURS 
// @param : Titre du test en cours
function continueTest() {

	$titre_test = isset($_POST['titre_test'])?($_POST['titre_test']):'';

    require_once("./model/getters.php");
    $resultat = getDatasFromTestName($titre_test);
 
   // REDEFINIR LES VARIABLES SESSIONS POUR CE TEST
    $_SESSION['test']['titre'] = $resultat['titre_test'];
    $_SESSION['test']['id'] = $resultat['id_test'];
    $_SESSION['test']['idProf'] = $resultat['id_prof'];
    $_SESSION['test']['numGrpe'] = $resultat['num_grpe'];
    $_SESSION['test']['date'] = $resultat['date_test'];
    $_SESSION['test']['bActif'] = $resultat['bActif'];

    // REDIRECTION
    $url = "index.php?action=afficherTest";
    header("Location:" .$url);

}

// AUTORISE LA QUESTION A ETRE AFFICHEE LORSQUE LE PROFESSEUR LA COCHE  
// @param : Tableau de questions  
function setQuestionsAffichables(){
    
	$questions = array();
	foreach ($_POST['question'] as $question) {
		$questions[] = $question;
	}

    foreach ($questions as $question) {
        require_once("./model/getters.php");
        require_once("./model/sessionBD.php");
        $id_quest = getIdQuestion($question);
        updateVisibilityQuestion($id_quest);
    }

    //REDIRECTION
    $url = "index.php?action=afficherTest";
    header("Location:" .$url);
}

// ARRETE L'ACTIVITE D'UN TEST
// @param : ID du test à stopper 
function stopTest(){

	$id_test = isset($_SESSION['test']['id'])?($_SESSION['test']['id']):'';

    require_once('./model/sessionBD.php');
    //createBilans($id_test);
    desactivateTest($id_test);
    deleteQCMs($id_test);
    unset($_SESSION['test']);

    //REDIRECTION 
    $url = "index.php?action=tableauDeBord";
    header("Location:" .$url);
}

// CREATION D'UN TEST
function createTest() {
	$titre = $_POST['titre'];
	$groupe = $_POST['groupe'];

	require_once('./model/professeurBD.php');
	addNewTest($titre, $groupe);

    //REDIRECTION
    $url = "index.php?action=tableauDeBord";
    header("Location:" .$url);	
}

// RETOURNE LES SESSIONS EN COURS
function sessionsEnCours() {
	require('./model/getters.php');
	return getSessionsEnCours($_SESSION['profil']['id']);
}

// RETOURNE LES SESSIONS DISPONIBLES
function testsAvailable() {
	require('./model/getters.php');
	return getTestsAvailable($_SESSION['profil']['id']);	
}

// ACCEDE AU BILAN
function bilan() {
	require('./view/bilan.php');	
}

