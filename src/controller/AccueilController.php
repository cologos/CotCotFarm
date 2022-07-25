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
        $this->setheader(new View('Header'));
        $this->setmenu(new View('Menu'));
        $this->setbody(new View('Body'));
        $this->setfooter(new View('Footer'));
        $this->setview(new View('Accueil'));

    }

    public function generateDisplay(): string
    {
        $allData = array();

        //generate Header View
        
        $allData['contentHeader'] = $this->getHeader()->generate();

        // generate Menu View 
       
        $allData['contentMenu'] = $this->getMenu()->generate();

         //generate Body View
         $newsController = new NewsController(new \PDO('pgsql:host=localhost;dbname=cotcotfarm;port=5432', 'appluser', 'applusermdpadm'));
         $news = $newsController->getSeveralNews(3);
         $allData['contentBody'] = $this->getBody()->generate( ['news'=> $news]);

        // generate Footer View
        
        $allData['contentFooter'] = $this->getFooter()->generate(); 
        
         // generate Global View 
        $allData['t'] = 'CotCotFarm';

        return $displayview = $this->getView()->generate($allData);

    }

    public function display(): void
    {
        echo $this->generateDisplay();
    }

    protected function setView(View $view): void
    {
        $this->view = $view;
    }

    protected function getView(): View
    {
        return $this->view;
    }

    protected function setHeader(View $header): void
    {
        $this->header = $header;
    }

    protected function getHeader(): View
    {
        return $this->header;
    }

    protected function setMenu(View $menu): void
    {
        $this->menu = $menu;
    }

    protected function getMenu(): View
    {
        return $this->menu;
    }

    protected function setBody(View $body): void
    {
        $this->body = $body;
    }

    protected function getBody(): View
    {
        return $this->body;
    }

    protected function setFooter(View $footer): void
    {
        $this->footer = $footer;
    }

    protected function getFooter(): View
    {
        return $this->footer;
    }

    /**
     * @return array<string>
     */
    public function getViewName(): array
    {
        $allViewName = array();
        
        $allViewName['Accueil'] = $this->getView()->getViewName();
        $allViewName['Header'] = $this->getHeader()->getViewName();
        $allViewName['Menu'] = $this->getMenu()->getViewName();
        $allViewName['Body'] = $this->getBody()->getViewName();
        $allViewName['Footer'] = $this->getFooter()->getViewName();

        return $allViewName;
    }

    public function __destruct()
    {
        unset($this->view);
        unset($this->header);
        unset($this->menu);
        unset($this->body);
        unset($this->footer);
    }
}