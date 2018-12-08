<?php

require ROOT . '/app/models/Petitions.php';

    class PetitionsController
    {
        public function IndexAction()
        {
            $title = "Петиции";
            $petitions = Petitions::getPetitionsList();

            $home = new View('index');
            $home->assign('petitions', $petitions);

            $layout = new View('layout');
            $layout->assign('title', $title);
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

        public function AddAction(){

//            $home
            $layout = new View('layout');
            $layout->display();
        }
    }