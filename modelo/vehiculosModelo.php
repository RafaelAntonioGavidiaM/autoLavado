<?php

include_once "conexion.php";

class VehiculosModelo
{
    public static function mdlInsertar($modelo, $dueño, $color, $placa, $imagen)
    {

        $mensaje = "";
        $nombreArchivo = $imagen['name'];
        $rutaArchivo = "../vista/imagenesVehiculos/" . $nombreArchivo;
        $extension = substr($nombreArchivo, -4);
        $url =  "vista/imagenesVehiculos/" . $nombreArchivo;


        if (($extension == ".jpg" || $extension == ".JPG") || ($extension == ".png" || $extension == ".PNG") || ($extension == "jpng"  || $extension == "JPNG")) {

            if (move_uploaded_file($imagen["tmp_name"], $rutaArchivo)) {

                try {

                    $objRespuesta = Conexion::conectar()->prepare("INSERT INTO carro(modelo,idDueño,color,placa,imagen) values (:modelo,:id,:color,:placa,:imagen)");
                    $objRespuesta->bindParam(":modelo", $modelo, PDO::PARAM_STR);
                    $objRespuesta->bindParam(":id", $dueño, PDO::PARAM_INT);
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

    public static function mdlListarTodos()
    {
        $ObjRespuesta = Conexion::conectar()->prepare("SELECT carro.idCarro,carro.modelo,carro.placa, carro.color,carro.imagen,dueño.nombre,dueño.apellidos,dueño.idDueño from carro inner join dueño on carro.idDueño=dueño.idDueño");
        $ObjRespuesta->execute();
        $listaCarro = $ObjRespuesta->fetchAll();
        $ObjRespuesta = null;
        return $listaCarro;
    }

    public static function mdlModificar($idCarro, $modelo, $dueño, $color, $placa, $imagen)
    {
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

    public static function mdlEliminar($idCarro)
    {
        $mensaje = "";
        if ($deleteImagen == "null") {

            try {
                $objRespuesta = conexion::conectar()->prepare("DELETE FROM carro WHERE idCarro='$idCarro'");
               
                if ($objRespuesta->execute()) {
                    $mensaje = "ok";
                }else {
                    $mensaje = "error";
                }
        
                $objRespuesta = null;

            } catch (Exception $e) {
               
                $mensaje = $e;
    
            }else{
                if (unlink("../".$deleteImagen)) { 
            
           
                    try {
                        $objRespuesta = conexion::conectar()->prepare("DELETE FROM carro WHERE idCarro='$idCarro'");
                       
                
                        if ($objRespuesta->execute()) {
                            $mensaje = "ok";
                        }else {
                            $mensaje = "error";
                        }
                
                        $objRespuesta = null;
                    } catch (Exception $e) {
                       
                        $mensaje = $e;
            
                    }
                } 
                else { 
        
                    $mensaje = "No se puede eliminar la imagen";
                }
            }
            
        return $mensaje;
    }

    public static function mdlModificarSinCambioImagen($idCarro,$modelo, $dueño, $color, $placa, $imagen){

        $mensaje =  "";

        try {

            $objRespuesta = conexion::conectar()->prepare("UPDATE carrro SET modelo='$modelo',dueño='$dueño',color='$color', placa='$placa',imagen='$imagen' WHERE idCarro='$Carro'");

        if ($objRespuesta->execute()){
            $mensaje = "ok";
        }else {
            $mensaje = "error";
        }

        $objRespuesta =  null;

        } catch (Exception $e) {

           $mensaje = $e;
        }
        
        return $mensaje;
    }

    public static function mdlModificarConCambioImagen($idCarro,$modelo, $dueño, $color, $placa, $imagen,$imagenAnterior){

        $mensaje = "";
        $nombreArchivo = $imagen['name'];
        $rutaArchivo = "../vista/imagenesVehiculos/" . $nombreArchivo;
        $extension = substr($nombreArchivo, -4);
        $url =  "vista/imagenesVehiculos/" . $nombreArchivo;

        if (($extension == ".jpg" || $extension == ".JPG") || ($extension == ".png" || $extension == ".PNG") || ($extension == "jpng"  || $extension == "JPNG")) {
            
            if (move_uploaded_file($imagen["tmp_name"], $rutaArchivo)) {

                if (unlink("../".$fotoAnterior)){

                    try {
        
                        $objRespuesta = conexion::conectar()->prepare("UPDATE carro SET modelo='$modelo',dueño='$dueño',color='$color', placa='$placa',imagen='$imagen' WHERE idCarro='$idCarro'");
            
                    if ($objRespuesta->execute()){
                        $mensaje = "ok";
                    }else {
                        $mensaje = "error";
                    }
            
                    $objRespuesta =  null;
            
                    } catch (Exception $e) {
            
                       $mensaje = $e;
                    }
                    
                }else {
                    
                    $mensaje = "Nose puede cambiar la imagen del registro";
                }
            }
        }
        
        return $mensaje;

    }
}

    public static function mdlCargarDuenos()
    {
        $objConsulta=conexion::conectar()->prepare("SELECT * from dueño");
        $objConsulta->execute();

        $lista= $objConsulta->fetchAll();

        $objConsulta=null;

        return $lista;
    }
}
