<?php

namespace cotcotfarm\controller;

use cotcotfarm\view\View;

class AccueilController
{

    private View $view;
    private View $menu;

    public function __construct()
    {
        $this->display();
    }

    public function display(): void
    {

        $this->menu = new View('Menu');
        $data = $this->menu->generate();
        
        $this->view = new View('Accueil');

        $this->view->generate($data);
    }
}