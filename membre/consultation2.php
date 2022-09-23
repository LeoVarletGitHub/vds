<?php
// Chargement dynamique des classes

/**
 * Consultation de la liste des membres
 */
require '../include/initialisation.php';
require '../include/controleacces.php';
$titreFonction = "Liste des membres";
$lesMembres = membre::getLesMembres();

$lesColonnes = ['Login', 'Nom et prénom', 'Mail', 'Aut.', 'Photo', 'Téléphone'];
$lesTailles = [15, 20, 30, 10, 10, 20];
$lesAlignements = ['L', 'C', 'C', 'L', 'L', 'L'];
$lesStyles = ['', '', '', '', '', ''];
$lesClasses = ['', '', '', '', '', ''];
$monTableau = new Tableau($lesColonnes, $lesTailles, $lesStyles, $lesClasses);

foreach ($lesMembres as $row) {
    $monTableau->ajouterLigne($row, $lesStyles, $lesClasses);
}
$monTableau->fermer();

require RACINE . '/include/head.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Amicale du Val de Somme</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<div class="container-fluid d-flex flex-column p-0 h-100">
    <main id="main" class="flex-grow-1 mx-3 ">
        <div id='contenu' class="m-3">
            <h3>Liste des membres</h3>
            <?= $monTableau->getTableau(); ?>
        </div>
    </main>
</div>
</html>
<?php require RACINE . '/include/pied.php'; ?>
