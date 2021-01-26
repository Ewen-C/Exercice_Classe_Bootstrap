<?php

  // Connexion
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_classe;charset=utf8', 'root', '');
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }

  // Rquête SQL
  $requete = 'INSERT INTO `eleve`(`nom`, `prenom`, `classe`, `genre`, `age`, `adresse`) VALUES ("' . $_POST['nom'] . '","' . $_POST['prenom'] . '","' . $_POST['classe'] . '","' . $_POST['genre'] . '","' . $_POST['age'] . '","' . $_POST['adresse'] . '")';
  $bdd->exec($requete);

  // Message de retour
  echo("L'élève ' " . $_POST['nom'] . " " . $_POST['prenom'] . " ' est ajouté dans la base de données !");

  
  // Incrément du nombre d'élèves de la classe de cet élève
  $reponse = $bdd->query('SELECT `nb_eleves` FROM `classe` WHERE `nom_classe` = "' . $_POST['classe'] . '"');
  while ($donnees = $reponse->fetch()) {
    $nbEleves =  $donnees['nb_eleves'] + 1;
  }
  $reponse = $bdd->query('UPDATE `classe` SET `nb_eleves`= ' . $nbEleves . ' WHERE `nom_classe` = "' . $_POST['classe'] . '"');
  $reponse->closeCursor();

?>