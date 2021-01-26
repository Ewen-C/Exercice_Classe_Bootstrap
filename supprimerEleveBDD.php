<?php

  // Connexion
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_classe;charset=utf8', 'root', '');
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }

  // Rquête SQL
  $requete = 'DELETE FROM `eleve` WHERE `nom` = "' . $_POST['nom'] . '" AND `prenom` = "' . $_POST['prenom'] . '" AND `classe` = "' . $_POST['classe'] . '"';
  //echo(" \nRequête : ". $requete);
  
  $bdd->exec($requete);


  // Décrémentation nb_eleves de la classe
  $reponse = $bdd->query('SELECT `nb_eleves` FROM `classe` WHERE `nom_classe` = "' . $_POST['classe'] . '"');

  $nbEleves = $reponse->fetch()['nb_eleves'] - 1;

  $reponse = $bdd->query('UPDATE `classe` SET `nb_eleves` = "' . $nbEleves . '" WHERE `nom_classe` = "' . $_POST['classe'] . '"');


  // Message de retour
  echo("L'élève ' " . $_POST['nom'] . " " . $_POST['prenom'] . " ' a bien été retiré de la classe de " . $_POST['classe'] . " !");

?>