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

                if (preg_match("~^$pattern$~", $uri)){
                    $intRoutes = preg_replace("~^$pattern$~", $route, $uri, 1);
//                    print_r($intRoutes);
                    $segments = explode('|', $intRoutes);

                    $controllerName = ucfirst(array_shift($segments)) . 'Controller';

                    $actionName = ucfirst(array_shift($segments)) . 'Action';

                    echo '<br>Контроллер: ' . $controllerName;  // TODO: temp line.
                    echo '<br>Экшен: ' . $actionName;           // TODO: temp line.
                }
            }

            if ($intRoutes == false){
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
            $controllerFile
//                = $_SERVER['DOCUMENT_ROOT']
                = 'app/controllers/' . $controllerName . '.php';

            if (file_exists($controllerFile))
            {
                require $controllerFile;

                // Создаем объект, вызываем action.
                $controllerObject = new $controllerName();
                if (method_exists($controllerObject, $actionName)){
                    $controllerObject->$actionName($params);   // TODO: params???
                } else throw new Exception("Action not found");

            } else throw new Exception("File not found");


        }

        private function getURI()
        {
            if (!empty($_SERVER['REQUEST_URI'])){
                return trim($_SERVER['REQUEST_URI'], '/');
            }
            if (!empty($_SERVER['PATH_INFO'])){
                return trim($_SERVER['PATH_INFO'], '/');
            }
            if (!empty($_SERVER['QUERY_STRING'])){
                return trim($_SERVER['QUERY_STRING'], '/');
            }
        }
    }