<?php

use PHPUnit\Framework\TestCase;
use cotcotfarm\controller\ConnexionController;

class ConnexionControllerTest extends TestCase
{
    /** @test */
    public function CheckConstructConnexionController(){

        //etant donné l'appel au controller ConnexionController

        ob_start();

        new ConnexionController();

        $result = ob_get_clean();

        //alors je m'attends :
        //à retrouver la chaine "Pseudo :" dans la page

        $this->assertEquals(strpos($result, "Pseudo"), true);

        //à retrouver la chaine "Password :" dans la page
        $this->assertEquals(strpos($result, "Password"), true); 
    }
}
