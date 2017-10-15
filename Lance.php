<?php

class Lance {

    private $usuario;
    private $valor;

    function __construct(Usuario $usuario, $valor) {
        $this->usuario = $usuario;
        if ($valor <= 0)
            throw new InvalidArgumentException();

        $this->valor = $valor;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getValor() {
        return $this->valor;
    }

}

?>


