<?php 

// VERIFIER IDENTIFIANT DANS BASE DONNEES
// @param Données à vérifier
function verif_ident_BD($login_utilisateur,$pass_utilisateur,$type_utilisateur){	
	require('frontEnd.php');
	$bdd = dbConnect();

	$resultat= array(); 

	// SI ELEVE --> REQUETE
	if($type_utilisateur == 'etudiant') {
		$sql="SELECT id_etu, login_etu, pass_etu, genre, nom, prenom, email, matricule, num_grpe, date_etu, bConnect FROM etudiant 
		WHERE login_etu =:login AND pass_etu=:pass";
		
		try {
			$req = $bdd->prepare($sql);
			$req ->execute(array(':login' => $login_utilisateur, ':pass' => $pass_utilisateur));
			$resultat = $req->fetchAll(PDO::FETCH_ASSOC);

			foreach($resultat as $show) {
				foreach($show as $display) {
					
				}
			}
		}
		catch (PDOException $e) {
			echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
			die(); // On arrête tout.
		}
	}

	// SI PROFESSEUR --> REQUETE
	if($type_utilisateur ==	 'professeur') {
		$sql="SELECT id_prof, login_prof, pass_prof, nom, prenom, email, date_prof, bConnect FROM professeur 
		WHERE login_prof =:login AND pass_prof=:pass";
		
		try {
			$req = $bdd->prepare($sql);
			$req ->execute(array(':login' => $login_utilisateur, ':pass' => $pass_utilisateur));
			$resultat = $req->fetchAll(PDO::FETCH_ASSOC);

			foreach($resultat as $show) {
				foreach($show as $display) {
					
				}
			}
		}
		catch (PDOException $e) {
			echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
			die(); // On arrête tout.
		}
	}
	
	// RESULTATS 
	if (empty($resultat)) {
		return false;
	}
	else {
		// bConnect DEFINI A 1
		try {
			$upd = "UPDATE ".$type_utilisateur." SET bConnect='1' WHERE nom='".$show['nom']."'";
			$stmt = $bdd->prepare($upd);
			$stmt->execute();

			echo $stmt->rowCount() . " records UPDATED successfully";	
		}
		catch(PDOException $e) {
			echo $upd . "<br>" . $e->getMessage();
		}

		$bdd = null;

		// AFFECTATION VARIABLES SESSION PROFIL UTILISATEUR
		$_SESSION['profil']['loginU'] = $login_utilisateur;
		$_SESSION['profil']['typeU'] = $type_utilisateur;
		$_SESSION['profil']['nom'] = $show['nom'];
		$_SESSION['profil']['prenom'] = $show['prenom'];
		$_SESSION['profil']['email'] = $show['email'];
		$_SESSION['profil']['bConnect'] = $show['bConnect']; 
		
		if($type_utilisateur == 'professeur') {
			$_SESSION['profil']['date_prof'] = $show['prenom'];
			$_SESSION['profil']['id'] = $show['id_prof'];	
		}
		else {
			$_SESSION['profil']['genre'] = $show['genre'];
			$_SESSION['profil']['num_grpe'] = $show['num_grpe'];
			$_SESSION['profil']['matricule'] = $show['matricule']; 
			$_SESSION['profil']['date_etu'] = $show['date_etu'];
			$_SESSION['profil']['id'] = $show['id_etu'];
		}

		return true;
	}
}
