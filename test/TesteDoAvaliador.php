
<?php

require "../Usuario.php";
require "../Lance.php";
require "../Leilao.php";
require "../Avaliador.php";
require "../CriadorDeLeilao.php";

class TesteDoAvaliador extends PHPUnit_Framework_TestCase {

    private $avaliador;
    private $criadorDeLeilao;
    private $joao;
    private $renan;
    private $felipe;

    public function setUp() {
        $this->avaliador = new Avaliador();
        $this->criadorDeLeilao = new CriadorDeLeilao();
        $this->joao = new Usuario("João");
        $this->renan = new Usuario("Renan");
        $this->felipe = new Usuario("Felipe");
    }

    public function testAceitaLeilaoEmOrdemCrescente() {


        $leilao = $this->criadorDeLeilao->para("Playstation 3")
                ->lance($this->joao, 250)
                ->lance($this->renan, 250)
                ->lance($this->felipe, 400)
                ->constroi();

        $this->avaliador->avalia($leilao);

        $maiorEsperado = 400;
        $menorEsperado = 250;
        $mediaEsperado = 300;


        $this->assertEquals($this->avaliador->getMaiorLance(), $maiorEsperado, 0.00001);
        $this->assertEquals($this->avaliador->getMenorLance(), $menorEsperado, 0.00001);
        $this->assertEquals($this->avaliador->getMediaLance(), $mediaEsperado, 0.00001);
    }

    public function testAceitaLeilaoEmOrdemDecrescente() {

        $leilao = $this->criadorDeLeilao
                ->para("Playstation 3")
                ->lance($this->joao, 400)
                ->lance($this->renan, 350)
                ->lance($this->felipe, 250)
                ->constroi();

        $this->avaliador->avalia($leilao);

        $maiorEsperado = 400;
        $menorEsperado = 250;
        $mediaEsperado = 333.33333333333;

        $this->avaliador->pegaOsMaioresNo($leilao);
        $maiores = $this->avaliador->getTresMaiores();

        $this->assertEquals($this->avaliador->getMaiorLance(), $maiorEsperado, 0.00001);
        $this->assertEquals($this->avaliador->getMenorLance(), $menorEsperado, 0.00001);
        $this->assertEquals($this->avaliador->getMediaLance(), $mediaEsperado, 0.00001);
        $this->assertEquals(count($maiores), 3);
        $this->assertEquals($maiores[0]->getValor(), 400);
        $this->assertEquals($maiores[1]->getValor(), 350);
        $this->assertEquals($maiores[2]->getValor(), 250);
    }

    public function testAceitaLeilaoEmOrdemAleatoria() {



        $leilao = $this->criadorDeLeilao->para("Playstation 3")
                ->lance($this->joao, 350)
                ->lance($this->renan, 400)
                ->lance($this->felipe, 250)
                ->constroi();

        $this->avaliador->avalia($leilao);

        $maiorEsperado = 400;
        $menorEsperado = 250;
        $mediaEsperado = 333.333333333333;

        $this->avaliador->pegaOsMaioresNo($leilao);
        $maiores = $this->avaliador->getTresMaiores();

        $this->assertEquals($this->avaliador->getMaiorLance(), $maiorEsperado, 0.00001);
        $this->assertEquals($this->avaliador->getMenorLance(), $menorEsperado, 0.00001);
        $this->assertEquals($this->avaliador->getMediaLance(), $mediaEsperado, 0.00001);
        $this->assertEquals(count($maiores), 3);
        $this->assertEquals($maiores[0]->getValor(), 400);
        $this->assertEquals($maiores[1]->getValor(), 350);
        $this->assertEquals($maiores[2]->getValor(), 250);
    }

    public function testAceitaLeilaoUncio() {

        $leilao = $this->criadorDeLeilao->para("Playstation 3")
                ->lance($this->renan, 400)
                ->constroi();

        $this->avaliador->avalia($leilao);

        $maiorEsperado = 400;
        $menorEsperado = 400;
        $mediaEsperado = 400;


        $this->avaliador->pegaOsMaioresNo($leilao);
        $maiores = $this->avaliador->getTresMaiores();

        $this->assertEquals($this->avaliador->getMaiorLance(), $maiorEsperado, 0.00001);
        $this->assertEquals($this->avaliador->getMenorLance(), $menorEsperado, 0.00001);
        $this->assertEquals($this->avaliador->getMediaLance(), $mediaEsperado, 0.00001);
        $this->assertEquals(count($maiores), 1);
        $this->assertEquals($maiores[0]->getValor(), 400);
    }

    public function testAceitaLeilaoListaVazia() {



        $leilao = $this->criadorDeLeilao->para("Playstation 3")
                ->constroi();


        $this->avaliador->avalia($leilao);

        $maiorEsperado = $menorEsperado = $mediaEsperado = 0;


        $this->avaliador->pegaOsMaioresNo($leilao);
        $maiores = $this->avaliador->getTresMaiores();

        $this->assertEquals($this->avaliador->getMaiorLance(), $maiorEsperado, 0.00001);
        $this->assertEquals($this->avaliador->getMenorLance(), $menorEsperado, 0.00001);
        $this->assertEquals($this->avaliador->getMediaLance(), $mediaEsperado, 0.00001);
        $this->assertEquals(count($maiores), 0);
    }

    public function TestaContaMaiorTrinta() {


        $this->assertEquals($this->avaliador->Conta(40), 160);
    }

    public function TestaContaTrinta() {


        $this->assertEquals($this->avaliador->Conta(30), 90);
    }

    public function TestaContaMenorTrintaMaiorDez() {


        $this->assertEquals($this->avaliador->Conta(20), 60);
    }

    public function TestaContaDez() {


        $this->assertEquals($this->avaliador->Conta(10), 20);
    }

    public function TestaContaMenorDez() {


        $this->assertEquals($this->avaliador->Conta(5), 10);
    }

}
