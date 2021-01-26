<?php

  // Connexion
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_classe;charset=utf8', 'root', '');
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }

  // Rquête SQL
  $requete = 'UPDATE `classe` SET `nom_classe` = "' . $_POST['nom_classe'] .  '" WHERE `nom_classe` = "' . $_POST['nom_classe_Debut'] . '"';
  
  $bdd->exec($requete);


  // Changement de classe pour les élèves concernés
  $reponse = $bdd->query('SELECT `nb_eleves` FROM `classe` WHERE `nom_classe` = "' . $_POST['nom_classe'] . '"');

  if($reponse->fetch() > 0) {
    $requete = 'UPDATE `eleves` SET `classe` = "' . $_POST['nom_classe'] .  '" WHERE `classe` = "' . $_POST['nom_classe_Debut'] . '"';
    $bdd->exec($requete);
  }
  
  // Message de retour
  echo("Les informations ont été mises à jour !");

?>