<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Élèves : Affichage</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" defer></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" defer></script>

  <script src="choixClasse.js" defer></script>
</head>

<body class="text-white bg-dark">

  <header class="container p-3 my-3 text-center border border-primary">
    <h1> Gestion des élèves </h1>
    <h2> <u class="text-primary"> <a href="affichageClasses.php">Gestion des classes</a> </u> </h2>
  </header>

  <aside class="container p-3 my-3 d-flex justify-content-center">

    <div class="col-10-sm d-flex flex-row justify-content-around">
      <button onclick="location.href = 'ajoutEleve.php'" class="btn btn-dark btn-outline-info text-light rounded-0 mx-3">
      Ajout d'un élève</button>
      <button onclick="location.href = 'modifEleve.php'" class="btn btn-dark btn-outline-info text-light rounded-0 mx-3">
      Modification / Suppression d'un élève</button>
    </div>

  </aside>

  <section class="container p-3 my-3 border border-primary">

    <?php

    // Connexion aux tables 'eleve' et 'classe' de la BDD
    try {
      $bdd = new PDO('mysql:host=localhost; dbname=gestion_classe; charset=utf8', 'root', '');
    } catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }

    // Choix de la classe

    echo ('<h4 class="text-center"> Choix de la classe : </h4>');

    echo('<div class="container p-3 my-3 d-flex justify-content-center">');
    echo ('<select id="choixClasse" class="custom-select col-sm-4 rounded-0">');

    $reponse = $bdd->query('SELECT * FROM `classe`'); // WHERE `nb_eleves` > 0
    while ($donnees = $reponse->fetch()) {
      echo ('<option> ' . $donnees['nom_classe'] . ' (' . $donnees['nb_eleves'] . ' élève' . (($donnees['nb_eleves'] > 1) ? "s" : "") . ') </option>');
    }

    echo ('</select>');
    echo("</div>");

    $reponse->closeCursor(); // Termine le traitement de la requête

    // Affichage des élèves

    echo ('<h4 class="text-center"> Liste des élèves de : ' . ' <u> <span id="selectedClass"> 6ème </span> </u> </h4>'); // Récupérer la valeur du dessus

    $reponse = $bdd->query('SELECT * FROM `eleve` WHERE `classe` = "6ème"'); // WHERE `classe` = "valeur du select"
    echo ('<div id="divEleves">');
      echo ('<table id="tableEleves" class="table table-dark table-striped table-bordered my-3">');

        echo ('<tr> ');
          echo (' <th> Nom </th>');
          echo (' <th> Prenom </th>');
          echo (' <th> Âge </th>');
          echo (' <th> Genre </th>');
          echo (' <th> Adresse </th>');
        echo (' </tr>');

        while ($donnees = $reponse->fetch()) {
          echo ('<tr> ');
            echo (' <td> ' . $donnees['nom'] . '</td>');
            echo (' <td> ' . $donnees['prenom'] . '</td>');
            echo (' <td> ' . $donnees['age'] . '</td>');
            echo (' <td> ' . $donnees['genre'] . '</td>');
            echo (' <td> ' . $donnees['adresse'] . '</td>');
          echo (' </tr>');
        }

        $reponse->closeCursor();
      echo ('</table>');
    echo ('</div>');

    ?>

  </section>

  <footer class="container p-3 my-3 text-center border border-primary">
    <p> Pages conçues par Ewen Celibert </p>
    <p> Exercice de développement donné par VLIS </p>
  </footer>

</body>

</html>