<?php 

// RETOURNE LES QUESTIONS AFFICHABLES : selon la décision du professeur
function getQuestionsAffichables(){
	require('frontEnd.php');
	$bdd = dbConnect();

	$sql = "SELECT question.id_quest, question.titre, question.texte, question.bmultiple FROM question, qcm WHERE question.id_quest=qcm.id_quest AND qcm.id_test=:id_test AND bAutorise=1";

	try {
		$req = $bdd->prepare($sql);
		$req ->execute(array(':id_test' => $_SESSION['test']['id']));
		return $req;
	}
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
}

// ENREGISTRE REPONSES DE L'ETUDIANT
// @param : ID de la réponse à enregistrer
function enregistrerReponseBD($id_rep) {
	require_once('./model/getters.php');
	$reponse = getDatasFromIdReponse($id_rep);

	require_once('frontEnd.php');
	$bdd = dbConnect();

	$sql = "INSERT INTO resultat (id_test, id_etu, id_quest, date_res, id_rep) 
	VALUES ('" . $_SESSION['test']['id'] . "', '" . $_SESSION['profil']['id'] . "', '" . $reponse['id_quest'] ."', CAST(NOW() AS DATE), '" . $reponse['id_rep'] ."')";

	try {
		$req = $bdd->prepare($sql);
		$req ->execute();		
	} 
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
}

// RETOURNE VRAI SI LA QUESTION A ETE REPONDU PAR L'ETUDIANT
function isAnswered($id_quest, $id_etu, $id_test) {
	require_once('frontEnd.php');
	$bdd = dbConnect();

	$sql = "SELECT * FROM resultat WHERE id_quest=:idQ AND id_etu=:idE AND id_test=:idT";

	try {
		$req = $bdd->prepare($sql);
		$req ->execute(array(':idQ' => $id_quest, ':idE' => $id_etu, ':idT' => $id_test));
		if(!empty($req->rowCount())){
			return true;
		}
		else {
			return false;
		}
	}
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}	
}

// RETOURNE VRAI SI LA REPONSE A ETE COCHEE PAR L'ETUDIANT
// @param Données correspondant à la question et étudiant
function isChecked($id_quest, $id_etu, $id_test, $id_rep) {
	require_once('frontEnd.php');
	$bdd = dbConnect();

	$sql = "SELECT * FROM resultat WHERE id_quest=:idQ AND id_etu=:idE AND id_test=:idT AND id_rep=:idR";

	try {
		$req = $bdd->prepare($sql);
		$req->execute(array(':idQ' => $id_quest, ':idE' => $id_etu, ':idT' => $id_test, ':idR' => $id_rep));
		if(!empty($req->rowCount())){
			return true;
		}
		else {
			return false;
		}
	}
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
}

// RETOURNE LE NOMBRE DE BONNES REPONSES D'UN ETUDIANT DONNE
// @param id_etu : ID étudiant 
function numberGoodAnswers($id_etu){
	require_once('frontEnd.php');
	$bdd = dbConnect();

	$sql = "SELECT bvalide FROM resultat, reponse WHERE id_etu=:idE AND resultat.id_rep = reponse.id_rep";

	$nbGoodAnswers = 0;

	try {
		$req = $bdd->prepare($sql);
		$req->execute(array(':idE' => $id_etu));
		foreach ($req as $reponse) {
			if($reponse['bvalide'] == 1){
				$nbGoodAnswers++;
			}
		}

		return $nbGoodAnswers;
	}
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}	
}

// RETOURNE LA LISTE DES ID DES ETUDIANTS D'UN GROUPE
function idEtudiantsFromGroupe($id_groupe) {
	require_once('frontEnd.php');
	$bdd = dbConnect();

	$sql = "SELECT id_etu, nom, prenom FROM etudiant WHERE num_grpe=:idG";

	$idEtudiants = array();

	try {
		$req = $bdd->prepare($sql);
		$req->execute(array(':idG' => $id_groupe));
	} 
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
	return $resultat;
}

// CREER UN BILAN INDIVIDUEL
function createBilan($id_test, $id_etu, $note) {
	require_once('frontEnd.php');
	$bdd = dbConnect();

	$sql = "INSERT INTO bilan (id_test, id_etu, note_test, date_bilan) 
	VALUES ('" . $id_test . "', '" . $id_etu . "', '" . $note ."', CAST(NOW() AS DATE))";

	try {
		$req = $bdd->prepare($sql);
		$req ->execute();		
	} 
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
}

function getEtudiantsFromGroupe($num_grpe){
  require_once('./model/frontEnd.php');
  $bdd = dbConnect();
  
  $sql="SELECT * FROM etudiant WHERE num_grpe=:numG";
  
  $resultat = array(); 
  
  try {
    $req = $bdd->prepare($sql);
    $req->execute(array(':numG' => $num_grpe));

    return $req;
  }
  catch (PDOException $e) {
    $msg = utf8_encode("Echec de select : " . $e->getMessage() . "\n");
    die($msg); // On arrête tout.
  }  
}

function getBilans($id_etu) {
	require_once('./model/frontEnd.php');
  $bdd = dbConnect();
  
  $sql="SELECT * FROM bilan WHERE id_etu=:idE";
  
  $resultat = array(); 
  
  try {
    $req = $bdd->prepare($sql);
    $req->execute(array(':idE' => $id_etu));

    return $req;
  }
  catch (PDOException $e) {
    $msg = utf8_encode("Echec de select : " . $e->getMessage() . "\n");
    die($msg); // On arrête tout.
  }	
}