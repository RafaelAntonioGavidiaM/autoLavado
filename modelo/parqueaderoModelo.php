<?php

require_once "conexion.php";

class parqueaderoModelo{

public static function mdlConsultarCarros(){

    $objConsulta = conexion::conectar()->prepare("select carro.idCarro,carro.modelo,carro.placa,dueño.nombre,dueño.apellidos from carro inner join dueño on carro.idDueño=dueño.idDueño");
    $objConsulta->execute();
    $lista = $objConsulta->fetchAll();

    $objConsulta=null;
    return $lista;
     


}

}