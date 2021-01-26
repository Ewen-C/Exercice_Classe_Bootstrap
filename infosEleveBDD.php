<?php

  // Connexion
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_classe;charset=utf8', 'root', '');
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }

  $optclasses[] = "";
  $reponse = $bdd->query("SELECT * FROM `classe`");
  for($i = 0; $donnees = $reponse->fetch(); $i++) {
    $optclasses[$i] = $donnees["nom_classe"];
  }

  // Rquête SQL
  $reponse = $bdd->query('SELECT * FROM `eleve` WHERE `nom` = "' . $_GET['nom'] . '" AND `prenom` = "' . $_GET['prenom'] . '" AND `classe` = "' . $_GET['classe'] . '"');

  echo ("<h3 class='text-center'> Informations de l'élève : </h3> ");

  // Informations de l'élève choisi
  $donnees = $reponse->fetch();


  // Affichage du formulaire pré-rempli
  echo('
    <div class="d-flex flex-row justify-content-center">
      <form id="formModif" class="col-md-6 m-3 p-3 border border-secondary">

        <div class="form-group row p-2">
          <label for="nom" class="col-4 col-form-label text-center"> Nom : </label>
          <input type="text" class="col-8 form-control rounded-0" name="nom" id="nom" maxlength="20" value="' . $donnees['nom'] .'" required>
        </div>

        <div class="form-group row p-2">
          <label for="prenom" class="col-4 col-form-label text-center"> Prenom : </label>
          <input type="text" class="col-8 form-control rounded-0" name="prenom" id="prenom" maxlength="20" value="' . $donnees['prenom'] . '" required>
        </div>

        <div class="form-group row p-2">
          <label for="age" class="col-4 col-form-label text-center"> Âge : </label>
          <input type="number" class="col-8 form-control rounded-0" name="age" id="age" min="0" max="99" value="' . $donnees['age'] .'"  required>
        </div>

        <div class="form-group row p-2">
          <label for="classe" class="col-4 col-form-label text-center"> Classe : </label>
          <select class="col-8 form-control rounded-0" name="classe" id="choixClasse"> '); 

      for($i = 0; $i < count($optclasses); $i++) {

        if($optclasses[$i] == $donnees['classe']) {
          echo("<option selected> ");
        } else {
          echo("<option> ");
        }

        echo($optclasses[$i]);
        echo(" </option>"); // Affichage des classes sans la méthode __toString() de PHP
      }
          
      echo(' </select>
        </div>

        <div class="form-group row p-2">
          <label for="genre" class="col-4 col-form-label text-center"> Genre : </label>
          <select name="genre" class="col-8 form-control rounded-0" id="genre" value="' . $donnees['genre'] .'"  required>
            <option value="M"> M </option>
            <option value="F"> F </option>
          </select>
        </div>

        <div class="form-group row p-2">
          <label for="adresse" class="col-4 col-form-label text-center"> Adresse : </label>
          <input type="text" class="col-8 form-control rounded-0" name="adresse" id="adresse" maxlength="50" value="' . $donnees['adresse'] . '"  required>
        </div>


        <div class="col-10-sm d-flex flex-row justify-content-around">
          <button type="submit" onclick="javascript:sendInfosEleve(event)" 
          class="btn btn-dark btn-outline-info text-light rounded-0 mx-3"> Modifier </button>

          <button type="submit" onclick="javascript:supprimerEleve(event)" 
          class="btn btn-dark btn-outline-info text-light rounded-0 mx-3"> Supprimer l\'élève </button>
        </div>

      </form>
    </div>');


  $reponse->closeCursor();

?>