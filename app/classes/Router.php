<?php

    class Router{

        private $routes;

        public function __construct()
        {
            $routesPath = 'app/config/routes.php';
            $this->routes = include($routesPath);

            $this->run();
        }

        public function run()
        {
            $uri = $this->getURI();
//            echo "uri = $uri<br>";

            // Проверим наличие такого запроса в routes.php
            foreach ($this->routes as $pattern => $route){
//echo "pattern = $pattern <br>";

                if (preg_match("~$pattern~", $uri)){
                    $result = preg_replace("~$pattern~", $route, $uri, 1);
//                    print_r($intRoutes);
                    $segments = explode('|', $result);

                    $controllerName = ucfirst(array_shift($segments)) . 'Controller';

                    $actionName = ucfirst(array_shift($segments)) . 'Action';

                    echo '<br>Контроллер: ' . $controllerName;  // TODO: temp line.
                    echo '<br>Экшен: ' . $actionName;           // TODO: temp line.
                }
            }

            if ($result == false){
                echo 'URI not found';
                exit;
            }

            // Получим параметры (если есть).
            $params = [];
            foreach ($segments as $segment){
                $kv = explode('=', $segment);

                if (isset($kv[1])){
                    $params[$kv[0]] = $kv[1];
                }
                else{
                    $params[] = $kv[0];
                }
            }
            echo "<br>";        // TODO: temp line.
            print_r($params);   // TODO: temp line.
            // Подключение файла класса контроллера.
        }

        private function getURI()
        {
            if (!empty($_SERVER['REQUEST_URI'])){
                return trim($_SERVER['REQUEST_URI'], '/');
            }
        }
    }