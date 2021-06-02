<?php

include_once "conexion.php";

class VehiculosModelo
{
    public static function mdlInsertar($modelo, $dueño, $color, $placa, $imagen)
    {

        $mensaje = "";
        $nombreArchivo = $foto['name'];
        $rutaArchivo = "../vista/imagenesPersonal/" . $nombreArchivo;
        $extension = substr($nombreArchivo, -4);
        $url =  "vista/imagenesPersonal/" . $nombreArchivo;


        if (($extension == ".jpg" || $extension == ".JPG") || ($extension == ".png" || $extension == ".PNG") || ($extension == "jpng"  || $extension == "JPNG")) {

            if (move_uploaded_file($foto["tmp_name"], $rutaArchivo)) {

                try {

                    $objRespuesta = Conexion::conectar()->prepare("INSERT INTO carro(modelo,idDueño,color,placa,imagen) values (:modelo,:id,:color,:placa,:imagen)");
                    $objRespuesta->bindParam(":modelo", $modelo, PDO::PARAM_STR);
                    $objRespuesta->bindParam(":id", $numero, PDO::PARAM_INT);
                    $objRespuesta->bindParam(":color", $color, PDO::PARAM_STR);
                    $objRespuesta->bindParam(":placa", $placa, PDO::PARAM_STR);
                    $objRespuesta->bindParam(":imagen", $url, PDO::PARAM_STR);


                    if ($objRespuesta->execute()) {
                        $mensaje = "ok";
                    } else {
                        $mesnaje = "error";
                    }
                } catch (Exception $e) {
                    
                    $mensaje = $e;

                }

            } else {
                $mensaje = "no fue posible subir el archivo";
            }
        } else {

            $mensaje = "El tipo del archivo no es compatible solo se resive archivos jpg,png y jpng";
        }

        return $mensaje;
    }

    public static function mdlListarTodos(){
        $ObjRespuesta = Conexion::conectar()->prepare("SELECT carro.idCarro,carro.modelo,carro.placa, carro.color,carro.imagen,dueño.nombre,dueño.apellidos,dueño.idDueño from carro inner join dueño on carro.idDueño=dueño.idDueño");
        $ObjRespuesta->execute();
        $listaCarro = $ObjRespuesta->fetchAll();
        $ObjRespuesta = null;
        return $listaCarro;
    }

    public static function mdlModificar($idCarro,$modelo, $dueño, $color, $placa, $imagen){
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


