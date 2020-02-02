<?php

// SE CONNECTER A LA BASE
function dbConnect(){
	try {
		//$bdd = new PDO('mysql:host=localhost;dbname=pweb19_nguyenva;charset=utf8', 'pweb19_nguyenva', 'x10022000');
		$bdd = new PDO('mysql:host=localhost;dbname=projetpweb;charset=utf8', 'root', '');
		return $bdd;
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}
}