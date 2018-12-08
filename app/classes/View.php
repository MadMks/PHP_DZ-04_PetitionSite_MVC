<?php

class View
{
    private $name;
    private $path;


    public function __construct($name)
    {
        $this->path = __DIR__ . '/../views/' . $name . '.php';
        if (!file_exists($this->path)){
            throw new Exception('Template not found');
        }

        $this->name = $name;

        de($this->name);
    }

    public function display(){
        echo $this->fetch();
    }


    public function fetch(){


        $content = '?';

        return $content;
    }
}