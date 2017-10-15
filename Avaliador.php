<?php

class Avaliador {

    private $MaiorLance = -INF;
    private $MenorLance = INF;
    private $MediaLance;
    private $maiores;

    public function Avalia(Leilao $leilao) {
        $total = 0;
        if (count($leilao->getLances()) > 0) {

            foreach ($leilao->getLances() as $lance) {

                if ($lance->getValor() >= $this->MaiorLance) {
                    $this->MaiorLance = $lance->getValor();
                }

                if ($lance->getValor() <= $this->MenorLance) {
                    $this->MenorLance = $lance->getValor();
                }

                $total += $lance->getValor();
            }

            $this->MediaLance = $total / count($leilao->getLances());
        }
    }

    public function getMaiorLance() {
        return $this->MaiorLance != -INF ? $this->MaiorLance : 0;
    }

    public function getMenorLance() {
        return $this->MenorLance != INF ? $this->MenorLance : 0;
    }

    public function getMediaLance() {
        return $this->MediaLance;
    }

    public function pegaOsMaioresNo(Leilao $leilao) {
        $lances = $leilao->getLances();

        usort($lances, function ($a, $b) {

            if ($a->getValor() == $b->getValor())
                return 0;

            return ($a->getValor() < $b->getValor()) ? 1 : -1;
        });

        $this->maiores = array_slice($lances, 0, 3);
    }

    public function getTresMaiores() {
        return $this->maiores;
    }

    public function Conta($numero) {
        if ($numero > 30)
            return $numero * 4;
        else if ($numero > 10)
            return $numero * 3;
        else
            return $numero * 2;
    }

}
