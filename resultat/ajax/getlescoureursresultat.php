<?php
/**
 * Fournit la liste des resultats des coureurs
 * Appel : resultat/resultati.js
 * Résultat :liste des resultats des coureurs au format json
 */

require '../../include/initialisation.php';

// récupération des informations sur les resultats

echo json_encode(resultat::getLesCoureursResultat());