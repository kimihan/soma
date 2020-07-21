<?php

function formataData($dataBanco)
{
    $date = new DateTime($dataBanco);
    return $date-> format( 'd/m/Y' );
}

function formataDataMysql($data){
    $ano= substr($data, 6);
    $mes= substr($data, 3,-5);
    $dia= substr($data, 0,-8);
    return $ano."-".$mes."-".$dia;
}