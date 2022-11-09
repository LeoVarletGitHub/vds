<?php
require '../include/initialisation.php';
require '../include/controleacces.php';
$titreFonction = "Gestion des courses";
require '../include/head.php';
?>
<script src="index.js"></script>
<div id="msg" class="m-3"></div>
<div class='row'>
    <div class="col-md-6 col-md-offset-3 text-center">
        <div class="card">
            <div class="card-header">
                <a>Ajout d'une course</a>
            </div>
            <div class="card-body">
                <input id="date" type="text" class="form-control recherche"
                       placeholder="Date"
                       pattern="^[0-9 -]+$"
                       autocomplete="off"
                >

                <select class="form-select input-sm" id='saison'>
                </select>

                <select class="form-select input-sm " id='distance'>
                    <option value="5km">5 km</option>
                    <option value="10km">10 km</option>
                </select>
            </div>
        </div>
    </div>
    <div class='table-responsive mt-1'>
        <table id='leTableau' class='table table-sm table-borderless tablesorter-bootstrap'
               style="font-size: 0.8rem">
            <thead>
            <tr>
                <th style=''>Date</th>
                <th style=''>Saison</th>
                <th style=''>Distance</th>
            </tr>
            </thead>
            <tbody id="lesLignes"></tbody>
        </table>
    </div>
</div>
<?php require '../include/pied.php'; ?>
