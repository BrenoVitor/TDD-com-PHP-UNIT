<?php

require '../AnoBissexto.php';

class TesteAnoBissexto extends PHPUnit_Framework_TestCase {

    public function testAnoBissexto() {
        $anoBissexto = new AnoBissexto(2016);
        
        $this->assertEquals(true, $anoBissexto->isAnoBissexto());
    }

}
