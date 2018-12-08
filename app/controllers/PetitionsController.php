<?php

require ROOT . '/app/models/Petitions.php';

    class PetitionsController
    {
        public function IndexAction()
        {
            $petitions = Petitions::getPetitionsList();

//            de('Список петиций:'); de('');
//            print_r($petitions); de('');
//            de('Кол-во петиций: ' . count($petitions));

            $home = new View('index');
            // TODO: assign - передача данных

            $layout = new View('layout');
            $layout->import('content', $home);
            $layout->display();
            return true;
        }

        public function ShowAction($params)
        {
//            echo "<br>";
//            echo "<br>";
//            echo 'PetitionsController - ShowAction';
//
//            echo "<br>";
//            echo "<br>";
            Petitions::getPetitionById($params['id']);

            $home = new View('show');
            return true;
        }
    }