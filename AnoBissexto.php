<?php

class AnoBissexto {

    private $ano;

    public function __construct($ano) {
        $this->ano = $ano;
    }

    public function isAnoBissexto() {
        if (($this->ano % 2 == 0 && $this->ano % 100 != 0) || ($this->ano % 400 == 0)) {
            return true;
        } else {
            return false;
        }
    }

}
