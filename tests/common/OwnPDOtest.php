<?php

namespace cotcotfarm\tests\common;

use PHPUnit\Framework\TestCase;
use cotcotfarm\common\OwnPDO;

class OwnPDOtest extends TestCase
{
    /**test */
    public function testOwnPDOConnexionSiteBase()
        {
            //etant donné l'appel a la class OwnPDO
            $pdo = new OwnPDO();
            //lorsque la connexion est effectuée
            $pdo->connect();
            //alors la connexion est effectuée avec succès
            $this->assertTrue($pdo->isConnected());
        }    
    }