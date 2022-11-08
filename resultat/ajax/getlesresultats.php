<?php
/**
 * Fournit la liste des resultats des courses
 * Appel : resultat/resultatc.js
 * Résultat :liste des resultats des courses au format json
 */

require '../../include/initialisation.php';

// récupération des informations sur les resultats

echo json_encode(resultat::getLesResultats());