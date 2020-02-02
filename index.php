<?php
session_start();
require('controller/etudiant.php');
require('controller/professeur.php');
require('controller/utilisateur.php');

$professeurActions = array (
    'setQuestionsAffichables',
    'startTest',
    'continueTest',
    'stopTest',
    'createTest',
    'bilan'
);

$etudiantActions = array(
    'enregistrerReponse',
    'joinSession',
    'commentaire'
);

$utilisateurActions = array(
    'login',
    'ident',
    'tableauDeBord',
    'logout',
    'afficherTest',
    'statistiques'
);

$pages = array(
    'pageUtilisation1',
    'pageUtilisation2',
    'pageUtilisation3',
    'pageDeveloppeurs',
    'register'
);

try {
    if(isset($_GET['action'])) {
        $action = $_GET['action'];

        if(in_array($action, $pages)) {
            $action ();
        }
        if(in_array($action, $utilisateurActions)) {
            $action ();
        }
        if(in_array($action, $etudiantActions)) {
            if(isset($_SESSION['profil']['typeU']) && $_SESSION['profil']['typeU'] == 'etudiant') {
                $action ();
            }
        }
        if(in_array($action, $professeurActions)) {
            if(isset($_SESSION['profil']['typeU']) && $_SESSION['profil']['typeU'] == 'professeur') {
                $action ();
            }
        }
    }
    else {
        index();
    }
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('./view/frontEnd/errorView.php');
}
