<?php
require '../../include/initialisation.php';
$id = $_POST["id"];
echo(resultat::supprimer($id));