<?php

    class PetitionsController
    {
        public function IndexAction()
        {
            echo "<br>";
            echo "<br>";
            echo 'PetitionsController - IndexAction';

            echo "<br>";
            echo "<br>";
            echo 'Список петиций';
            return true;
        }

        public function ShowAction($params)
        {
            echo "<br>";
            echo "<br>";
            echo 'PetitionsController - ShowAction';

            echo "<br>";
            echo "<br>";
            echo 'Одна петиция' . "<br>";
            print_r($params);
            return true;
        }
    }