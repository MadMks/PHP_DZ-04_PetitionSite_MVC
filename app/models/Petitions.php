<?php

class Petitions
{
    public static function getPetitionById($id)
    {
        $dbh = DB::getConnection();

        $sth = $dbh->prepare(
            'SELECT p.*, users.email AS author 
            FROM petitions AS p
            LEFT JOIN users
              ON p.user_id = users.id
            WHERE p.id = :petitionId'
        );
        $sth->bindValue(':petitionId', $id);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_OBJ);
    }

    public static function getPetitionsList()
    {
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