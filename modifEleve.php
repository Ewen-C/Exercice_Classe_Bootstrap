<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Eleves : Édition</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" defer></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" defer></script>

  <script src="modifEleve.js" defer></script>
</head>

<body class="text-white bg-dark">

  <header class="container p-3 my-3 text-center border border-primary">
    <h1>Modification / Suppression d'un élève</h1>
    <h2> <u class="text-primary"> <a href="affichageEleves.php">Retour</a> </u> </h2>
  </header>

  <section class="container p-3 my-3 border border-primary">

    <?php

    try {
      $bdd = new PDO('mysql:host=localhost; dbname=gestion_classe; charset=utf8', 'root', '');
    } catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }

    echo ("<h3 class='text-center'> Choix de l'élève : </h3>");

    echo ('<div class="d-flex flex-column justify-content-center align-items-center">');

      echo ('<select class="col-md-4 form-control rounded-0 my-3" id="choixEleve">');
        echo ('<option selected> -- Choisir un élève -- </option>');

        $reponse = $bdd->query('SELECT * FROM `eleve` ORDER BY `eleve` . `classe` DESC ');
        while ($donnees = $reponse->fetch()) {
          echo ('<option> ' . $donnees['nom'] . ' ' . $donnees['prenom'] . ' (' . $donnees['classe'] . ') </option>');
        }

      echo ('</select>');
      echo ('<div id="divModif" class="container"> </div>'); 
      // La classe container ici est importante pour que le formulaire puisse prendre toute la largueur nécessaire

    echo('</div>');
    ?>

  </section>

  <footer class="container p-3 my-3 text-center border border-primary">
    <p> Pages conçues par Ewen Celibert </p>
    <p> Exercice de développement donné par VLIS </p>
  </footer>

  <div class="modal fade text-dark" id="modalData">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-body" id="modal-body"> </div>

        <div class="modal-footer d-flex justify-content-around" id="modal-footer"> </div>

      </div>
    </div>
  </div>

</body>

</html>