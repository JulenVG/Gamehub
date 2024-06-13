<?php

//Esta función se encarga de escoger que tipo de filtro se está aplicando
function ordenTabla($orden,$tipoOrden){
    if($tipoOrden == "ASC"){
        switch($orden){
            case "titulo":
                return "tituloASC";
            case "nota":
                return "notaASC";
            case "actualmenteJugando":
                return "actualmenteJugando";
            case "completado":
                return "completado";
            case "abandonado":
                return "abandonado";
            case "intencionDeJugar":
                return "intencionDeJugar";    
        }
    }else if($tipoOrden == "DES"){
        switch($orden){
            case "titulo":
                return "tituloDES";
            case "nota":
                return "notaDES";
            case "actualmenteJugando":
                return "actualmenteJugando";
            case "completado":
                return "completado";
            case "abandonado":
                return "abandonado";
            case "intencionDeJugar":
                return "intencionDeJugar"; 
        }
    }
}

//Filtro de nota descendiente
function notaDES($a, $b){
    if($a->getValoraciones()->getNota() == $b->getValoraciones()->getNota()){
        return 0;
    }
    if($a->getValoraciones()->getNota() > $b->getValoraciones()->getNota()){
        return -1;
    }else {
        return 1;
    }
}

//Filtro de nota ascendiente
function notaASC($a, $b){
    if($a->getValoraciones()->getNota() == $b->getValoraciones()->getNota()){
        return 0;
    }
    if($a->getValoraciones()->getNota() < $b->getValoraciones()->getNota()){
        return -1;
    }else {
        return 1;
    }
}

//Filtro de titulo descendiente
function tituloDES($a, $b){
    return strcasecmp($a->getNombre(), $b->getNombre());
}

//Filtro de titulo ascendente
function tituloASC($a, $b){
    return strcasecmp($b->getNombre(), $a->getNombre());
}

//Filtro ordenar por actualmente jugando
function actualmenteJugando($a,$b){
    $estadosOrden = array('Actualmente jugando', 'Completado', 'Abandonado', 'Intención de jugar');
    $posicionA = array_search($a->getEstado(), $estadosOrden);
    $posicionB = array_search($b->getEstado(), $estadosOrden);
    return $posicionA - $posicionB;
}

//Filtro ordenar por completado
function completado($a,$b){
    $estadosOrden = array('Completado', 'Actualmente jugando', 'Abandonado', 'Intención de jugar');
    $posicionA = array_search($a->getEstado(), $estadosOrden);
    $posicionB = array_search($b->getEstado(), $estadosOrden);
    return $posicionA - $posicionB;
}

//Filtro ordenar por abandonado
function abandonado($a,$b){
    $estadosOrden = array('Abandonado', 'Actualmente jugando', 'Completado', 'Intención de jugar');
    $posicionA = array_search($a->getEstado(), $estadosOrden);
    $posicionB = array_search($b->getEstado(), $estadosOrden);
    return $posicionA - $posicionB;
}

//Filtro ordenar por intencion de jugar
function intencionDeJugar($a,$b){
    $estadosOrden = array('Intención de jugar', 'Actualmente jugando', 'Completado', 'Abandonado');
    $posicionA = array_search($a->getEstado(), $estadosOrden);
    $posicionB = array_search($b->getEstado(), $estadosOrden);
    return $posicionA - $posicionB;
}
?>
