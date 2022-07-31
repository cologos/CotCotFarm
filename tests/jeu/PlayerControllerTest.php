<?php

namespace cotcotfarm\tests\jeu;

use PHPUnit\Framework\TestCase;
use cotcotfarm\jeu\entities\Player;
use cotcotfarm\jeu\controller\PlayerController;

class PlayerControllerTest extends TestCase
{

    private $pdo;
    private $playerController;

    protected function setUp() : void
    {
        $this->pdo = new \PDO('pgsql:host=localhost;dbname=cotcotfarm', 'appluser', 'applusermdpadm', [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ]);

        $this->playerController = new PlayerController($this->pdo);
    }

    /**@test */
    public function testPlayerControllerShouldBeAbleToCreateAPlayer(){
        //etant donné la création d'un nouveau joueur et
        //l'introduction de son nom d'éleveur et du nom de son exploitation
        $newPlayer = new Player("Cologos","CologoFarm");        
        //alors le portefeuille du joueur est alimenté de 1000 CotCotDollard et le nom de l'éleveur est "cologos" et le nom de de son exploitation "cologos" sont enregistré en base de donnée
        $this->assertEquals(1000,$newPlayer->getWalletAmount());
        $this->assertEquals('Cologos',$newPlayer->getPseudo());
        $this->assertEquals('CologoFarm',$newPlayer->getfarmName());
    }
}