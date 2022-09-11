<?php

namespace cotcotfarm\tests\common;

use PHPUnit\Framework\TestCase;
use cotcotfarm\common\OwnPDO;
use cotcotfarm\site\entities\News;

class OwnPDOTest extends TestCase
{
    /**test */
    public function testOwnPDOConnexionSiteBase()
    {
            //etant donné l'appel a la class OwnPDO
            $pdo = new OwnPDO('Site');
            //lorsque la connexion est effectuée
            $pdo->connect();
            //alors la connexion est effectuée avec succès
            $this->assertTrue($pdo->isConnected());
    }    

    /**test */
    public function testOwnPDOConnexionGameBase()
    {
        //etant donné l'appel a la class OwnPDO
        $pdo = new OwnPDO('Game');
        //lorsque la connexion est effectuée
        $pdo->connect();
        //alors la connexion est effectuée avec succès
        $this->assertTrue($pdo->isConnected());
    }

    /**
    * @test
    * @throws Exception
    */  
    public function testOwnPDOConnexionError()
    {
        //etant donné l'appel a la class OwnPDO
        //lorsque j'appelle le constructeur de la class OwnPDO avec un base inconnu
        //alors une exception est lancée
        $this->expectExceptionMessage("Section 'Error' not found in './config/config.ini'");
        $pdo = new OwnPDO('Error');
    }

    /** test */
    public function testInsertdataInTheDatabase()
    {
        //etant donné :
        //les variables string $base = 'site' 
        $base = 'Site';
        //l'objet News avec un titre, un contenu, un auteur et une date de publication
        $data = new News(0,'titlePdo', 'contentPdo', 'authorPdo', "2022-08-01 00:00:00");
        //l'appel au constructeur de la class OwnPDO sur la base $base
        $pdo = new OwnPDO($base);
        //lorsque la connexion est effectuée avec succès
        $pdo->connect();
        //lorsque j'appelle la méthode insert de la class OwnPDO
        //j'insert les données $data dans la table ayant pour nom le type de la classe de $data dans la base $base
        $pdo->insert($data);       
        //alors les données sont insérées dans la base
        $pdo->getData($data);     
    }
}