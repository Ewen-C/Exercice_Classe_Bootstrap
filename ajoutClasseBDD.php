<?php

  // Connexion
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_classe;charset=utf8', 'root', '');
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }

  // Rquête SQL
  $requete = 'INSERT INTO `classe`(`nom_classe`, `nb_eleves`) VALUES ("' . $_POST["nom_classe"] . '",0)';
  
  $bdd->exec($requete);
  //echo ("<script> console.log('Requête PHP : $requete '); </script>"); // Le contenu du console.log doit être entre guillemets simples

  // Message de retour
  echo("La classe ' " . $_POST['nom_classe'] . " ' est ajoutée dans la base de données !");
?>