<?php
/**
 * Fournit la liste des coureurs
 * Appel : resultat/resultati.js
 * Résultat :liste des coureurs au format json
 */

require '../../include/initialisation.php';

// récupération des informations sur les resultats

echo json_encode(resultat::getLesCoureurs());