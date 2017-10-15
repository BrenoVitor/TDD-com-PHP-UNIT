<?php

require '../Leilao.php';
require '../Lance.php';
require '../Usuario.php';
require "../CriadorDeLeilao.php";

class TesteLeilao extends PHPUnit_Framework_TestCase {

    private $leilao;
    private $gates;
    private $jobs;

    public function setUp() {
        $this->leilao = new Leilao("MacBook Pro");
        $this->gates = new Usuario("Gates");
        $this->jobs = new Usuario("Jobs");
    }

    public function testeDeveReceberUmLance() {

        $this->assertEquals(0, count($this->leilao->getLances()));

        $this->leilao->propoe(new Lance(new Usuario("Jobs"), 10000));

        $this->assertEquals(1, count($this->leilao->getLances()));

        $this->assertEquals(10000, $this->leilao->getLances()[0]->getValor(), 0.1);
    }

    public function testeDeveReceberDescricao() {

        $this->assertEquals("MacBook Pro", $this->leilao->getDescricao());
    }

    public function testeNaoAceitarDoisLancesSeguidosDoMesmoUsuario() {

        $this->leilao->propoe(new Lance(new Usuario("Gates"), 1000));

        //ignore
        $this->leilao->propoe(new Lance(new Usuario("Gates"), 1500));

        $this->assertEquals(1, count($this->leilao->getLances()));

        $this->assertEquals(1000, $this->leilao->getLances()[0]->getValor());
    }

    public function testeNaoAceitaMaisDeCincoLancesDoMesmoUsuario() {


        $this->leilao->propoe(new Lance(new Usuario("Gates"), 1000));
        $this->leilao->propoe(new Lance(new Usuario("Jobs"), 2000));

        $this->leilao->propoe(new Lance(new Usuario("Gates"), 3000));
        $this->leilao->propoe(new Lance(new Usuario("Jobs"), 4000));

        $this->leilao->propoe(new Lance(new Usuario("Gates"), 5000));
        $this->leilao->propoe(new Lance(new Usuario("Jobs"), 6000));

        $this->leilao->propoe(new Lance(new Usuario("Gates"), 7000));
        $this->leilao->propoe(new Lance(new Usuario("Jobs"), 8000));

        $this->leilao->propoe(new Lance(new Usuario("Gates"), 9000));
        $this->leilao->propoe(new Lance(new Usuario("Jobs"), 10000));

        $this->leilao->propoe(new Lance(new Usuario("Gates"), 11000));
        $this->leilao->propoe(new Lance(new Usuario("Jobs"), 12000));

        $this->assertEquals(10, count($this->leilao->getLances()));
        $this->assertEquals(10000, $this->leilao->getLances()[9]->getValor());
        $this->assertEquals(new Usuario("Jobs"), $this->leilao->getLances()[9]->getUsuario());
    }

    public function testeDobraValorDoLance() {

        $this->leilao->propoe(new Lance(new Usuario("Gates"), 1000));
        $this->leilao->propoe(new Lance(new Usuario("Jobs"), 2000));

        $this->leilao->dobraLance(new Usuario("Gates"));

        $this->assertEquals(3, count($this->leilao->getLances()));
        $this->assertEquals(2000, $this->leilao->getLances()[2]->getValor());
    }

    public function testeDobraValorDoLanceSeguido() {

        $this->leilao->propoe(new Lance(new Usuario("Gates"), 1000));

        $this->leilao->dobraLance(new Usuario("Gates"));

        $this->assertEquals(1, count($this->leilao->getLances()));
        $this->assertEquals(1000, $this->leilao->getLances()[0]->getValor());
    }

    public function testeDobraValorDoLanceMaisDeCincoLances() {
        $leilao = new Leilao("MackBook Pro");

        $this->leilao->propoe(new Lance(new Usuario("Gates"), 1000));
        $this->leilao->propoe(new Lance(new Usuario("Jobs"), 2000));

        $this->leilao->propoe(new Lance(new Usuario("Gates"), 3000));
        $this->leilao->propoe(new Lance(new Usuario("Jobs"), 4000));

        $this->leilao->propoe(new Lance(new Usuario("Gates"), 5000));
        $this->leilao->propoe(new Lance(new Usuario("Jobs"), 6000));

        $this->leilao->propoe(new Lance(new Usuario("Gates"), 7000));
        $this->leilao->propoe(new Lance(new Usuario("Jobs"), 8000));

        $this->leilao->propoe(new Lance(new Usuario("Gates"), 9000));
        $this->leilao->propoe(new Lance(new Usuario("Jobs"), 10000));

        $this->leilao->dobraLance(new Usuario("Gates"));

        $this->assertEquals(10, count($this->leilao->getLances()));
        $this->assertEquals(10000, $this->leilao->getLances()[9]->getValor());
        $this->assertEquals(new Usuario("Jobs"), $this->leilao->getLances()[9]->getUsuario());
    }

    public function testeDobraValorNaoTemLanceAnterior() {


        $this->leilao->propoe(new Lance(new Usuario("Gates"), 1000));

        $this->leilao->dobraLance(new Usuario("Jobs"));

        $this->assertEquals(1, count($this->leilao->getLances()));
        $this->assertEquals(1000, $this->leilao->getLances()[0]->getValor());
        $this->assertEquals(new Usuario("Gates"), $this->leilao->getLances()[0]->getUsuario());
    }

    /**
     * @expectedException  Exception
     */
    public function testNaoDeveAvaliarLeiloesSemNenhumLanceDado() {
        $criador = new CriadorDeLeilao();
        $leilao = $criador->
                para("Playstation 3 Novo")
                ->constroi();

        $this->leiloeiro->avalia($leilao);
    }

}
