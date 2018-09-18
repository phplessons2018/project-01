<?php
namespace App;


class TwigClass
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function defaultPage()
    {
        echo "Default";
    }

    public function twig()
    {
        $this->view->twigLoad('test', ['test' => 'asd', 'isTest' => true]);
    }
}