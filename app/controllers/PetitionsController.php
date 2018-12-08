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
            $petition = Petitions::getPetitionById($params['id']);
            $title = $petition->title;

            $home = new View('show');
            $home->assign('petition', $petition);

            $layout = new View('layout');
            $layout->assign('title', $title);
            $layout->import('content', $home);
            $layout->display();
            return true;
        }

        public function AddAction(){

            $title = "Добавление петиции";

            $home = new View('add');

            $layout = new View('layout');
            $layout->assign('title', $title);
            $layout->import('content', $home);
//            $layout->display();

            // Сообщение о выполнении.
            if (!empty($_POST)){
                $message = new View('message');
                if (Petitions::addPetition()){
                    $message->assign('status', 'alert-success');
                    $message->assign(
                        'text',
                        'На почту отправлено письмо для подтверждения...');
                }else{
                    $message->assign('status', 'alert-warning');
                    $message->assign(
                        'text',
                        'Ошибка. Письмо для подтверждения не отправлено.');
                }
                $home->import('addInfo', $message);
            }

            // Выводим на экран.
            $layout->display();
        }
    }