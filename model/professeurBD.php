<?php

function addNewTest($titreTest, $numGrpe) {
	require_once('./model/frontEnd.php');
	$bdd = dbConnect();

	$sql="INSERT INTO test(id_prof, num_grpe, titre_test, date_test, bActif) VALUES ('".$_SESSION['profil']['id']."','".$numGrpe."','".$titreTest."', DATE(NOW()), 0)";

	$resultat = array(); 

	try {
		$req = $bdd->prepare($sql);
		$req->execute(array());

	}
	catch (PDOException $e) {
		$msg = utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die($msg); // On arrête tout.
	}  
} 

function getEtudiantsBilans($id_prof, $id_grpe) {
	require_once('./model/frontEnd.php');
  $bdd = dbConnect();
  
  $sql="SELECT * FROM bilan AS B, etudiant AS E WHERE B.id_etu=:idP AND B.id_etu=E.id_etu AND E.id_grpe=:idG";
  
  $resultat = array(); 
  
  try {
    $req = $bdd->prepare($sql);
    $req->execute(array(':idP' => $id_prof, ':idG' => $id_grpe));

    return $req;
  }
  catch (PDOException $e) {
    $msg = utf8_encode("Echec de select : " . $e->getMessage() . "\n");
    die($msg); // On arrête tout.
  }		
}





