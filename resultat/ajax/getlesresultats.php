<?php
/**
 * Fournit la liste des resultats de courses
 * Appel : resultat/resultatc.js
 * Résultat :liste des resultats de courses au format json
 */

require '../../include/initialisation.php';

// récupération des informations sur les resultats

echo json_encode(resultat::getLesResultats());