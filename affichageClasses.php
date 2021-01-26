<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Classes : Affichage</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" defer></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" defer></script>
</head>


<body class="text-white bg-dark">

  <header class="container p-3 my-3 text-center border border-primary">
    <h1> Gestion des classes </h1>
    <h2> <u class="text-primary"> <a href="affichageEleves.php">Gestion des élèves</a> </u> </h2>
  </header>

  <aside class="container p-3 my-3 d-flex justify-content-center">

    <div class="col-10-sm d-flex flex-row justify-content-around">
      <button onclick="location.href = 'ajoutClasse.php'" class="btn btn-dark btn-outline-info text-light rounded-0 mx-3">
      Ajout d'une classe</button>
      <button onclick="location.href = 'modifClasse.php'" class="btn btn-dark btn-outline-info text-light rounded-0 mx-3">
      Modifier le nom d'une classe</button>
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


    echo ('<h4 class="text-center"> Résumé des classes : </h4>');

    $reponse = $bdd->query('SELECT * FROM `classe`');
    echo ('<div id="divClasses">');
      echo ('<table id="tableClasses" class="table table-dark table-striped table-bordered my-3">');

      echo ('<tr> ');
        echo (' <th> Nom de la classe </th>');
        echo (" <th> Nombre d'élèves </th>");
      echo (' </tr>');

      while ($donnees = $reponse->fetch()) {
        echo ('<tr> ');
          echo (' <td> ' . $donnees['nom_classe'] . '</td>');
          echo (' <td> ' . $donnees['nb_eleves'] . '</td>');
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