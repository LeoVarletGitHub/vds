<?php

class resultat
{
    public static function getLesResultats(): array
    {
        $valeur = trim($_POST['valeur']);

        $db = Database::getInstance();
        $sql = <<<EOD
            Select place, temps, (select distance from course where id=idCourse) as distance, (select concat(nom, ' ' , prenom) from coureur where id = idCoureur) as nomPrenom, 
                   categorie, placeCategorie, club, (select date from course where id = idCourse) as date, (select saison from course where id=idCourse) as saison
            From resultat
            Order by idCourse and place;
EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;
    }

    public static function getLesCoureurs(): array
    {
        $db = Database::getInstance();
        $sql = <<<EOD

EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;

    }
}