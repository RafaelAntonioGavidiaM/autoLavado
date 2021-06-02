<?php

include_once "conexion.php";

class VehiculosModelo
{
    public static function mdlInsertar($modelo, $dueño, $color, $placa, $imagen)
    {

        $numero = $dueño;
        $mensaje = "";
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO carro(modelo,idDueño,color,placa,imagen) values (:modelo,:id,:color,:placa,:imagen)");
            $objRespuesta->bindParam(":modelo", $modelo, PDO::PARAM_STR);
            $objRespuesta->bindParam(":id", $numero, PDO::PARAM_INT);
            $objRespuesta->bindParam(":color", $color, PDO::PARAM_STR);
            $objRespuesta->bindParam(":placa", $placa, PDO::PARAM_STR);
            $objRespuesta->bindParam(":imagen", $imagen, PDO::PARAM_STR);
            if ($objRespuesta->execute()) {
                $mensaje = "ok";
            } else {
                $mensaje = "error";
            }
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = $e;
        }
        return $mensaje;
    }

    public static function mdlListarTodos(){
        $ObjRespuesta = Conexion::conectar()->prepare("SELECT * FROM carro");
        $ObjRespuesta->execute();
        $listaCarro = $ObjRespuesta->fetchAll();
        $ObjRespuesta = null;
        return $listaCarro;
    }

    public static function mdlModificar($idCarro,($modelo, $dueño, $color, $placa, $imagen){
        $mensaje = "";
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE carro SET modelo='$modelo',dueño='$dueño',color='$color',placa='$placa',imagen='$imagen' WHERE idCarro='$idCarro'");
            if ($objRespuesta->execute()) {
                $mensaje = "ok";
            } else {
                $mensaje = "error";
            }
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = $e;
        }
        return $mensaje;
    }

    public static function mdlEliminar($idCarro){
        $mensaje = "";
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM carro WHERE idCarro='$idCarro");
            if ($objRespuesta->execute()) {
                $mensaje = "ok";
            } else {
                $mensaje = "error";
            }
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = $e;
        }
        return $mensaje;

    }
}


}