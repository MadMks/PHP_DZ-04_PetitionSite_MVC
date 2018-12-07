<?php

require ROOT . '/app/models/Petitions.php';

    class PetitionsController
    {
        public function IndexAction()
        {
            $petitions = Petitions::getPetitionsList();

            de('Список петиций:'); de('');
            print_r($petitions); de('');
            de('Кол-во петиций: ' . count($petitions));

            return true;
        }

        public function ShowAction($params)
        {
            echo "<br>";
            echo "<br>";
            echo 'PetitionsController - ShowAction';

            echo "<br>";
            echo "<br>";
            Petitions::getPetitionById($params['id']);
            return true;
        }
    }