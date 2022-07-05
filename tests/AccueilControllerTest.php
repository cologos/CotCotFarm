<?php

use PHPUnit\Framework\TestCase;
use cotcotfarm\controller\AccueilController;

class AccueilControllerTest extends TestCase
{
    /**test */
    public function testDisplay()
    {
        //etant donné que le controller est instancié
        $controller = new AccueilController();

        //lorsque la fonction display du controller est appelée
        ob_start();
        $controller->display();
        $result = ob_get_clean();

        //on s'attend a trouver dans le résultat le mot "CotCotFarm" montrant qu'on a bien afficher la vue Accueil
        $this->assertStringContainsString('CotCotFarm', $result);

        //on s'attend a trouver dans le résultat la balise <div class="header"> montrant qu'on a bien afficher la vue Header
        $this->assertStringContainsString('<div class="header">', $result);

        //on s'attend a trouver dans le résultat la balise <div class="Presbody"> montrant qu'on a bien afficher la vue Body
        $this->assertStringContainsString('<div class="Presbody">', $result);

        //on s'attend a trouver dans le résultat la balise <ul class="headerMenu"> montrant qu'on a bien afficher la vue Menu
        $this->assertStringContainsString('<ul class="headerMenu">', $result);

        //on s'attend a trouver dans le résultat la balise <ul class="headerMenu"> montrant qu'on a bien afficher la vue Menu
        $this->assertStringContainsString('<div class="footer">', $result);
    }

    /**test */
    public function testGetViewName()
    {
        //etant donné que le controller est instancié
        $controller = new AccueilController();

        //lorsque la fonction getViewName du controller est appelée sur les vues Accueil, header, menu, body, footer    
        //le résultat attendu est de recevoir le nom de la vue Accueil, header, menu, body, footer

        $this->assertEquals('Accueil', $controller->getViewName()['Accueil']);
        $this->assertEquals('Header', $controller->getViewName()['Header']);
        $this->assertEquals('Menu', $controller->getViewName()['Menu']);
        $this->assertEquals('Body', $controller->getViewName()['Body']);
        $this->assertEquals('Footer', $controller->getViewName()['Footer']);
  
    }
}
