<?php

class resultat
{
    public static function getLesCoureurs(): array
    {
        $db = Database::getInstance();
        $sql = <<<EOD
           select id, concat(nom, ' ' , prenom) as nomPrenom
           from coureur
EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;

    }

    public static function getLesCoureursResultat(): array
    {
        $idCoureur = trim($_POST['idCoureur']);

        $db = Database::getInstance();
        $sql = <<<EOD
            Select place, temps, course.distance  as distance, categorie, placeCategorie, concat(nom, ' ' , prenom) as nomPrenom,
                   club, course.date as date
            From resultat
            join course on resultat.idCourse = course.id
            join coureur on resultat.idCoureur = coureur.id
            where idCoureur = $idCoureur
            order by idCourse;
EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;

    }

    public static function getLesCourses(): array
    {
        $db = Database::getInstance();
        $sql = <<<EOD
           select id, concat(date, ' ', saison, ' ', distance) as nomCourse, distance
           from course
EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;

    }

    public static function getLesResultats(): array
    {
        $idCourse = trim($_POST['idCourse']);
        $db = Database::getInstance();
        $sql = <<<EOD
            Select place, temps, course.distance  as distance, concat(nom, ' ' , prenom) as nomPrenom, 
                   categorie, placeCategorie, club, coureur.sexe as sexe
            From resultat
            join course on resultat.idCourse = course.id
            join coureur on resultat.idCoureur = coureur.id
            where idCourse = $idCourse
            Order by place;
EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;
    }

    public static function getLesDonnees(): array
    {
        $db = Database::getInstance();
        $sql = <<<EOD
    SELECT distinct categorie
    FROM resultat
EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;
    }
}