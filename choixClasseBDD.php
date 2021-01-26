<?php

  // Connexion
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_classe;charset=utf8', 'root', '');
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }

  // Rquête SQL
  $reponse = $bdd->query('SELECT * FROM `eleve` WHERE `classe` = "' . $_GET['classe'] . '"');
  //echo ("<script> console.log('Requête PHP : $requete '); </script>"); // Le contenu du console.log doit être entre guillemets simples

  echo ('<table id="tableEleves" class="table table-dark table-striped table-bordered my-3">');
  
    echo ('<tr> ');
      echo (' <th> Nom </th>');
      echo (' <th> Prenom </th>');
      echo (' <th> Âge </th>');
      echo (' <th> Genre </th>');
      echo (' <th> Adresse </th>');
    echo (' </tr>');

    // Renvoi des infos des élèves de la classe sélectionnée
    while ($donnees = $reponse->fetch()) {
      echo ('<tr> ');
        echo (' <td> ' . $donnees['nom'] . '</td>');
        echo (' <td> ' . $donnees['prenom'] . '</td>');
        echo (' <td> ' . $donnees['age'] . '</td>');
        echo (' <td> ' . $donnees['genre'] . '</td>');
        echo (' <td> ' . $donnees['adresse'] . '</td>');
      echo (' </tr>');
    }

  echo ('</table>');

  $reponse->closeCursor();
?>