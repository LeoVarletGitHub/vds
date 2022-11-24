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

    public static function Coursesnonparticipant(): array
    {
        $db = Database::getInstance();
        $sql = <<<EOD
    SELECT id, date, saison, distance
    FROM course
    where nbParticipant = 0;
EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;
    }

    public static function Ajouter(string $date, string $saison, string $distance): bool
    {
        $ok = false;
        $sql = <<<EOD
            Select date, saison, distance
            From course
            Where year(date) = year(:date) and saison = :saison and distance = :distance;
EOD;
        $db = Database::getInstance();
        $curseur = $db->prepare($sql);
        $curseur->bindParam('date', $date);
        $curseur->bindParam('saison', $saison);
        $curseur->bindParam('distance', $distance);
        $curseur->execute();
        $ligne = $curseur->fetch();
        $curseur->closeCursor();
        if ($ligne)
            $reponse = "Cet course existe déjà";
        else {
            $sql = <<<EOD
        insert into course(date, saison, distance)
        values (:date, :saison, :distance);
EOD;

            $curseur = $db->prepare($sql);
            $curseur->bindParam('date', $date);
            $curseur->bindParam('saison', $saison);
            $curseur->bindParam('distance', $distance);
            try {
                $curseur->execute();
                $curseur->closeCursor();
                $ok = true;
            } catch (Exception $e) {
                $reponse = substr($e->getMessage(), strrpos($e->getMessage(), '#') + 1);
            }
        }
        return $ok;
    }

    public static function supprimer(int $id)
    {
        $db = Database::getInstance();
        $sql = <<<EOD
    delete from course
    where id = :id and nbParticipant = 0;
EOD;
        $curseur = $db->prepare($sql);
        $curseur->bindParam('id', $id);
        try {
            $curseur->execute();
            $curseur->closeCursor();
            echo 1;
        } catch (Exception $e) {
            echo substr($e->getMessage(), strrpos($e->getMessage(), '#') + 1);
        }
    }
}


