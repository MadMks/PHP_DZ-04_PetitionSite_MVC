<?php

class Petitions
{
    public static function getPetitionById($id)
    {
        echo "<br> Данные одной статьи id = $id, из DB";
    }

    public static function getPetitionsList()
    {
        de('данные всех статей из DB');

        $dbh = DB::getConnection();

        $sql = 'SELECT petitions.*, users.email AS author_email
			FROM petitions
			LEFT JOIN users 
			  ON (petitions.user_id = users.id)
            LEFT JOIN state_of_petitions AS statePetition
              ON (petitions.id = statePetition.petition_id)
            WHERE statePetition.active = 1
			';
        $sth = $dbh->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_OBJ);
    }
}