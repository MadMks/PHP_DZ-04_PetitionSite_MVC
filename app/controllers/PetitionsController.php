<?php

require 'app/models/Petitions.php';

    class PetitionsController
    {
        public function IndexAction()
        {
            echo "<br>";
            echo "<br>";
            echo 'PetitionsController - IndexAction';

            echo "<br>";
            echo "<br>";
            Petitions::getPetitionsList();
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