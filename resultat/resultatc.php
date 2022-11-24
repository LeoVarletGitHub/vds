<?php

require '../include/initialisation.php';
$titreFonction = "Course";
require '../include/head.php';
?>
<script src="resultatc.js"></script>
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.bootstrap_4.min.css"/>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/easy-autocomplete.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/easy-autocomplete.themes.min.css">

<div id="msg" class="m-3"></div>

<div class="row">
    <div class="col-12 col-sm-2 boite">
        <input id="nomR" type="text" class="form-control recherche"
               placeholder="Date, Saison et/ou distance"
               pattern="^[0-9a-zA-Z -]+$"
               autocomplete="off"
        >
    </div>
    <div class="col-12 col-sm-2">
        <label for="sexe"> Sexe : </label>
        <select class="form-select input-sm " id='sexe'>
            <option value="*">Homme et Femme</option>
            <option value="M">Homme</option>
            <option value="F">Femme</option>
        </select>
    </div>
    <div class="col-12 col-sm-2">
        <label for="idCategorie"> Catégorie : </label>
        <select class="form-select input-sm" id='idCategorie'>
            <option value="*">Toutes les catégories</option>
        </select>
    </div>

</div>

<div class='table-responsive mt-1'>
    <table id='leTableau' class='table table-sm table-borderless tablesorter-bootstrap'
           style="font-size: 0.8rem">
        <thead>
        <tr>
            <th style=''>Place</th>
            <th style=''>Temps</th>
            <th style=''>Vitesse</th>
            <th style=''>Allure au Km</th>
            <th style=''>Coureur</th>
            <th style=''>Cat/Clt</th>
            <th style=''>Place dans la categorie</th>
            <th style=''>Club</th>
        </tr>
        </thead>
        <tbody id="lesLignes"></tbody>
    </table>
</div>
<?php require '../include/pied.php'; ?>
