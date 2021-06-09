<?php

require_once "conexion.php";

class informeCarroModelo {

    public static function mdlConsultar($idCarro){

        $objConsulta =conexion::conectar()->prepare("select distinct( lavado.idCarro ) as carroConsulta, carro.modelo,carro.placa, carro.imagen, dueño.nombre, dueño.apellidos from lavado inner join carro on lavado.idCarro=carro.idCarro inner join dueño on dueño.idDueño=carro.idDueño where lavado.idCarro=:idCarro");
        $objConsulta->bindParam(":idCarro", $idCarro, PDO::PARAM_INT);
        $objConsulta->execute();
        $lista= $objConsulta->fetch();

        $objConsulta=null;
        return $lista;





    }



}