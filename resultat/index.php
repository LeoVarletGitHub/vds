<?php
require '../include/initialisation.php';
require '../include/controleacces.php';
$titreFonction = "Gestion des courses";
require '../include/head.php';
?>
<script src="index.js"></script>
<div id="msg" class="m-3"></div>
<div class='row'>
    <div class="col-6 text-center">
        <div class="card">
            <div class="card-header">
                <a>Ajout d'une course</a>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="col-6 text-center ">
        <div class="card">
            <div class="card-header">
                <a>Supprimer une course</a>
            </div>
            <div class="card-body">
                Uniquement possible si la course ne possède pas de résultats
            </div>
        </div>
    </div>
</div>
<?php require '../include/pied.php'; ?>
