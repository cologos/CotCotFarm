<?php

namespace cotcotfarm\controller;

use cotcotfarm\view\View;

class ConnexionController
{

    private View $view;

    public function __construct()
    {
        $this->display();
    }

    public function display(): void
    {

        $this->view = new View('Connexion');

        $this->view->generate();
    }
}
