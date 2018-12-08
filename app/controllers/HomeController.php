<?php

    class HomeController
    {
        public function IndexAction()
        {
            echo "<br>";
            echo "<br>";
            echo 'HomeController - IndexAction';

            $home = new View('index');
            return true;
        }
    }