<?php

namespace cotcotfarm\controller;

use cotcotfarm\view\View;

class AccueilController
{

    private View $view;
    private View $menu;
    private View $header;
    private View $footer;
    private View $body;


    public function __construct()
    {
        $this->display();
    }

    public function display(): void
    {
        $displayview = "";
        $allData = array();

        //generate Header View
        $this->header = new View('Header');
        $allData['contentHeader'] = $this->header->generate();

        // generate Menu View 
        $this->menu = new View('Menu');
        $allData['contentMenu'] = $this->menu->generate();

         //generate Body View
         $this->body = new View('Body');
         $allData['contentBody'] = $this->body->generate();

        // generate Footer View
        $this->footer = new View('Footer');
        $allData['contentFooter'] = $this->footer->generate();
        
         // generate Global View 
        $allData['t'] = 'CotCotFarm';
        $this->view = new View('Accueil');
        $displayview = $this->view->generate($allData);
        $this->view->display($displayview);

    }

    public function __destruct()
    {
        unset($this->view);
        unset($this->menu);
        unset($this->header);
        unset($this->footer);
        unset($this->body);
    }
}