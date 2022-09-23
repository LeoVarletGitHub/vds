<?php

class resultat
{
    public static function getLesResultats(): array
    {
        $db = Database::getInstance();
        $sql = <<<EOD
            Select place, temps, (select distance from course where id = idCourse) / (select sum(Left(temps, 2) + substring(temps, 4,2) * 60 + substring(temps, 7,2)) 
                                                                                      from resultat where id = idCourse) * 3600), 
                                                    (select concat(nom, ' ' , prenom) from coureur where id = idCoureur) as nomPrenom
            From resultat
            Order by place;
EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;
    }
}