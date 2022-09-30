<?php

class resultat
{
    public static function getLesResultats(): array
    {
        $db = Database::getInstance();
        $sql = <<<EOD
            Select place, temps, (select distance from course where id=idCourse) as distance, (select concat(nom, ' ' , prenom) from coureur where id = idCoureur) as nomPrenom, categorie, placeCategorie, club, (select date)
            From resultat
            where idCourse = (select id from course where ) 
            Order by idCourse and place;
EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;
    }
}