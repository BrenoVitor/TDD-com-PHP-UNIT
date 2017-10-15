<?php

function CarregaClasses($classe) {
    require  $classe . ".php";
}

spl_autoload_register(CarregaClasses($classe));



