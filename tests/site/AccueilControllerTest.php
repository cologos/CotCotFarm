<?php

namespace cotcotfarm\tests;

use PHPUnit\Framework\TestCase;
use cotcotfarm\site\controller\AccueilController;
class AccueilControllerTest extends TestCase
{
    /**test */
    public function testGenerateView()
    {
        //etant donné la creation d'un controller AccueilController 

        $accueil = new AccueilController();

        //lorsque j'appelle la methode generateDisplay sur la vue header du controller AccueilController

        $result = $accueil->generateDisplay();

        //je m'attend a trouver dans le résultat le mot "CotCotFarm" montrant que la vue accueil a bien été générée
        $this->assertStringContainsString('CotCotFarm', $result);

        //on s'attend a trouver dans le résultat la balise <div class="header"> ontrant que la vue Header a bien été générée
        $this->assertStringContainsString('<div class="header">', $result);

        //on s'attend a trouver dans le résultat la balise <div class="Presbody"> ontrant que la vue Body a bien été générée
        $this->assertStringContainsString('<div class="Presbody">', $result);

        //on s'attend a trouver dans le résultat la balise <ul class="headerMenu"> ontrant que la vue Menu a bien été générée
        $this->assertStringContainsString('<ul class="headerMenu">', $result);

        //on s'attend a trouver dans le résultat la balise <ul class="headerMenu"> ontrant que la vue Menu a bien été générée
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
