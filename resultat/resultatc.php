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
<div id="msg" class="m-3"></div>
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
