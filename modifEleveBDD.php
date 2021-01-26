<?php

  // Connexion
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_classe;charset=utf8', 'root', '');
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }

  // Rquête SQL
  $requete = 'UPDATE `eleve` SET `nom`="' . $_POST['nom'] . '",`prenom`="' . $_POST['prenom'] . '",`classe`="' . $_POST['classe'] . '",`genre`="' . $_POST['genre'] . '",`age`="' . $_POST['age'] . '",`adresse`="' . $_POST['adresse'] . '" WHERE `nom` = "' . $_POST['nomDebut'] . '" AND `prenom` = "' . $_POST['prenomDebut'] . '" AND `classe` = "' . $_POST['classeDebut'] . '"';
  //echo(" \nRequête : ". $requete);
  
  $bdd->exec($requete);


  if($_POST['classe'] != $_POST['classeDebut']) { // Changement de classe

    // Décrémentation nb_eleves de la classe de départ
    $reponse = $bdd->query('SELECT `nb_eleves` FROM `classe` WHERE `nom_classe` = "' . $_POST['classeDebut'] . '"');

    $nbEleves = $reponse->fetch()['nb_eleves'] - 1;

    $reponse = $bdd->query('UPDATE `classe` SET `nb_eleves` = "' . $nbEleves . '" WHERE `nom_classe` = "' . $_POST['classeDebut'] . '"');


    // Incrémentation nb_eleves de la classe d'arrivée
    $reponse = $bdd->query('SELECT `nb_eleves` FROM `classe` WHERE `nom_classe` = "' . $_POST['classe'] . '"');

    $nbEleves = $reponse->fetch()['nb_eleves'] + 1;

    $reponse = $bdd->query('UPDATE `classe` SET `nb_eleves` = "' . $nbEleves . '" WHERE `nom_classe` = "' . $_POST['classe'] . '"');
  }

  // Message de retour
  echo("Les informations ont été mises à jour !");

?>