<?php

require '/app/components/functions.php';

class Petitions
{
    // TODO: $dbh ???

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

    public static function addPetition()
    {
        $dbh = DB::getConnection();

        if (!empty($_POST)){
            if (isset($_POST['btnSubmit'])
                && !empty($_POST['btnSubmit'])
                && !empty($_POST['title'])
                && !empty($_POST['email'])
                && !empty($_POST['description'])
            ) {

                // Есть ли зарегестрированный автор (по емайл).
                $sth = $dbh->prepare(
                    "SELECT * FROM users
                WHERE email = :email"
                );
                $sth->bindValue(':email', $_POST['email']);
                $sth->execute();
                $userEmail = $sth->fetch(PDO::FETCH_ASSOC);

                if (empty($userEmail)) {
                    // Добавление нового автора (емайл).
                    $sth = $dbh->prepare(
                        "INSERT INTO users (email)
                    VALUES (:email)"
                    );
                    $sth->bindValue(':email', $_POST['email']);
                    $sth->execute();
                    // новый запрос для получения id user email
                    $sth = $dbh->prepare(
                        "SELECT * FROM users
                    WHERE email = :email"
                    );
                    $sth->bindValue(':email', $_POST['email']);
                    $sth->execute();
                    $userEmail = $sth->fetch(PDO::FETCH_ASSOC);
                }
                // Добавление петиции.
                $sth = $dbh->prepare(
                    "INSERT INTO petitions (title, user_id, description)
                      VALUES (:title, :user_id, :description)"
                );
                $sth->bindValue(':title', $_POST['title']);
                $sth->bindValue(':user_id', $userEmail['id']);
                $sth->bindValue(':description', $_POST['description']);
                $sth->execute();
                // Получение id петиции.
                $sth = $dbh->prepare(
                    "SELECT * FROM petitions
                WHERE title = :title
                AND user_id = :user_id"
                );
                $sth->bindValue(':title', $_POST['title']);
                $sth->bindValue(':user_id', $userEmail['id']);
                $sth->execute();
                $petition = $sth->fetch(PDO::FETCH_ASSOC);
                // Добавление петиции в таблицу состояний.
                $sth = $dbh->prepare(
                    "INSERT INTO state_of_petitions 
                    (user_id, petition_id, activationKey)
                VALUES (:user_id, :petition_id, :activationKey)"
                );
                $token = uniqid();
                $sth->bindValue(':user_id', $userEmail['id']);
                $sth->bindValue(':petition_id', $petition['id']);
                $sth->bindValue(':activationKey', $token);
                $result = $sth->execute();
                if ($result) {
                    sendMail($userEmail['email'], $petition['id'], $token);
                }
                $_SESSION['message'] = 'success';

//                echo "<script>";
//                echo "window.location=document.URL;";
//                echo "</script>";

                return true;
            }
            // header('Location: /add.php');

        }
//        echo "<script>";
//        echo "window.location=document.URL;";
//        echo "</script>";

        return false;
    }
}