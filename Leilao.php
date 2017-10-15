<?php

class Leilao {

    private $descricao;
    private $lances;

    function __construct($descricao) {
        $this->descricao = $descricao;
        $this->lances = array();
    }

    public function propoe(Lance $lance) {

        if (count($this->getLances()) == 0 || ($this->podeDarLance($lance->getUsuario())))
            $this->lances[] = $lance;
    }

    public function dobraLance(Usuario $usuario) {

        $UltimoLance = $this->getUlimoLanceDo($usuario);
        if (!is_null($UltimoLance))
            $this->propoe(new Lance($usuario, $UltimoLance *= 2));
    }

    public function getUlimoLanceDo(Usuario $usuario) {
        $UltimoLance = null;
        foreach ($this->getLances() as $lance) {
            if ($lance->getUsuario() == $usuario) {
                $UltimoLance = $lance->getValor();
            }
        }

        return $UltimoLance;
    }

    public function podeDarLance(Usuario $usuario) {
        return !($this->getUltimoLance()->getUsuario() == $usuario) &&
                ($this->getNumeroDeLanceDoUsuario($usuario) < 5);
    }

    public function getUltimoLance() {
        return $this->getLances()[count($this->getLances()) - 1];
    }

    public function getNumeroDeLanceDoUsuario(Usuario $usuario) {
        $total = 0;

        foreach ($this->getLances() as $lance) {
            if ($lance->getUsuario() == $usuario) {
                $total++;
            }
        }

        return $total;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getLances() {
        return $this->lances;
    }

    

}
?>


















































