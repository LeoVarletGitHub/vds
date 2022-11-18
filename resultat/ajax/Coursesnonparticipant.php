<?php

require '../../include/initialisation.php';

// récupération des informations sur les resultats

echo json_encode(resultat::Coursesnonparticipant());