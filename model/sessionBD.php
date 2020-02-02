<?php

// VERIFIER SI SESSION EN COURS
// @param : nom du test 
function verif_test_available($nomTest) {
  require('frontEnd.php');
  $bdd = dbConnect();

  $sql = "SELECT id_test, id_prof, num_grpe, titre_test, date_test, bActif FROM test WHERE titre_test=:nomTest AND num_grpe=:numGrpe";

  $resultat = array(); 
  
  try {
    $req = $bdd->prepare($sql);
    $req ->execute(array(':nomTest' => $nomTest, ':numGrpe' => $_SESSION['profil']['num_grpe']));
    $resultat = $req->fetch(PDO::FETCH_ASSOC);

  }
  catch (PDOException $e) {
    echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
    die();
  }

  if($resultat['bActif'] == 1){
    // VARIABLES SESSIONS : MEMORISER LE TEST EN COURS
    $_SESSION['test']['titreTest'] = $nomTest;
    $_SESSION['test']['id'] = $resultat['id_test'];
    $_SESSION['test']['idProf'] = $resultat['titre_test'];
    $_SESSION['test']['numGrpe'] = $resultat['num_grpe'];
    $_SESSION['test']['date'] = $resultat['date_test'];
    $_SESSION['test']['bActif'] = $resultat['bActif']; 
    return true;
  }
  else {
    return false;
  }
}

// CREATION DE QCM : PROFESSEUR CHOISI LES QUESTIONS A TRAITER
// @param : titre du test
function createQCMs($titre_test){
  require_once("./model/sessionBD.php");
  $idTest = getIdTest($titre_test);

  $resultat = getQuestions();

  require_once('./model/frontEnd.php');
  $bdd = dbConnect();

  while($row = $resultat->fetch()) { 
    try {
      $sql = "INSERT INTO qcm (id_test, id_quest, bAutorise, bBloque, bAnnule) VALUES ('".$_SESSION['test']['id'] . "','" . $row['id_quest'] . "','0', '0', '0')";
      $bdd->exec($sql);   
    }
    catch(PDOException $e){
      echo $sql . "<br>" . $e->getMessage();
    }
  }
}

  // AUTORISE L'AFFICHAGE DES QUESTIONS : bAutorise 0 --> 1 dans Base de Données
  // @param : ID de la question à rendre visible
function updateVisibilityQuestion($id_quest) {
  require_once('./model/frontEnd.php');
  $bdd = dbConnect();

  $sql = "UPDATE qcm SET bAutorise = 1 WHERE qcm.id_quest=:id_quest";       
  
  try {
    $req = $bdd->prepare($sql);
    $req->execute(array(':id_quest' => $id_quest));
  }
  catch (PDOException $e) {
    echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
      die(); // On arrête tout.
    }
  }

  // VERIFIE SI UNE QUESTION EST AFFICHABLE : selon la décision du professeur
  // @param : ID de la question 
  function isAffichable($id_quest, $id_test){
    require_once('./model/frontEnd.php');
    $bdd = dbConnect();

    $sql = "SELECT bAutorise FROM qcm WHERE qcm.id_quest=:id_quest AND qcm.id_test=:id_test";       
    
    try {
      $req = $bdd->prepare($sql);
      $req->execute(array(':id_quest' => $id_quest, ':id_test' => $id_test));
      $bAutorise = $req->fetch();
      if($bAutorise['bAutorise'] == '1'){
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

  // ACTIVATION D'UN TEST
  function activateTest($id_test){
    require_once('./model/frontEnd.php');
    $bdd = dbConnect();

    $sql = "UPDATE test SET bActif = 1 WHERE test.id_test=:id_test";       
    
    try {
      $req = $bdd->prepare($sql);
      $req->execute(array(':id_test' => $id_test));
    }
    catch (PDOException $e) {
      echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
      die(); // On arrête tout.
    }
  }

  // DESACTIVATION D'UN TEST
  function desactivateTest($id_test){
    require_once('./model/frontEnd.php');
    $bdd = dbConnect();

    $sql = "UPDATE test SET bActif = 0 WHERE test.id_test=:id_test";       
    
    try {
      $req = $bdd->prepare($sql);
      $req->execute(array(':id_test' => $id_test));
    }
    catch (PDOException $e) {
      echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
      die(); // On arrête tout.
    }
  }

  // SUPPRIMER LES QUESTIONS DU QCM D'UN TEST
  function deleteQCMs($id_test){
    require_once('./model/frontEnd.php');
    $bdd = dbConnect();

    $sql = "DELETE FROM qcm WHERE id_test=:idT";

    try {
      $req = $bdd->prepare($sql);
      $req->execute(array(':idT' => $id_test));
    }
    catch (PDOException $e) {
      echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
      die(); // On arrête tout.
    }
  }

  // RETOURNE SI UNE REPONSE EST VALIDE
  // @param : ID de la réponse
  function isValid($id_rep){
    require_once('./model/frontEnd.php');
    $bdd = dbConnect();

    $sql = "SELECT bvalide FROM reponse WHERE id_rep=:idR";

    try {
      $req = $bdd->prepare($sql);
      $req->execute(array(':idR' => $id_rep));
      if($req['bvalide'] == 1){
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

  // FAIRE LE BILAN DU TEST
  function createBilans($id_test) {
    require_once('./model/frontEnd.php');
    $bdd = dbConnect();


    $nbQuestions = nbQuestion($id_test);

    require_once('./model/etudiantBD.php');
    $idEtudiantsGroupe = idEtudiantsFromGroupe($_SESSION['test']['numGrpe']);
    
    // POUR CHAQUE ETUDIANT DU GROUPE 
    foreach ($idEtudiantsGroupe as $idEtudiant) {
      require_once('./model/etudiantBD.php');
      $note = numberGoodAnswers($idEtudiant) * 20 / $nbQuestions; 
      require_once('./model/etudiantBD.php');
      createBilan($id_test, $idEtudiant, $note);
    }
  }

  function nbQuestion($idTest) {
    require_once('./model/frontEnd.php');
    $bdd = dbConnect();

    $sql = "SELECT id_qcm FROM qcm WHERE id_test=:idT AND bAutorise = 1";

    try {
      $req = $bdd->prepare($sql);
      $req->execute(array(':idT' => $idTest));
    }
    catch (PDOException $e) {
      echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
      die(); // On arrête tout.
    }
    return $req->rowCount();
  }