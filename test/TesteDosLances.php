<?php

class TesteDosLances extends PHPUnit_Framework_TestCase {

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDeveRecusarLancesComValorDeZero() {
        new Lance(new Usuario("John Doe"), 0);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDeveRecusarLancesComValorNegativo() {
        new Lance(new Usuario("John Doe"), -10);
    }

}
