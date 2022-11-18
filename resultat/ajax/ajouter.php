<?php
require '../../include/initialisation.php';
$date = $_POST["date"];
$saison = $_POST["saison"];
$distance = $_POST["distance"];
echo(resultat::Ajouter($date, $saison, $distance));