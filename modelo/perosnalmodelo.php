<?php

include_once "conexion.php";

class PersonalModelo
{


    public static function mdlListarPersonal()
    {

        $objListarPersonal = conexion::conectar()->prepare("SELECT * FROM personal");
        $objListarPersonal->execute();
        $listaPersonal = $objListarPersonal->fetchAll();
        $objListarPersonal = null;
        return $listaPersonal;
    }

    public static function mdlBuscarPersonal($idPersonal)
    {

        $objBuscarPersonal = conexion::conectar()->prepare("SELECT * FROM personal WHERE idPersonal= '$idPersonal'");
        $objBuscarPersonal->execute();
        $BuscarPersonal = $objBuscarPersonal->fetch();
        $objBuscarPersonal = null;
        return $BuscarPersonal;
    }



    public static function mdlRegPersonal($documento, $nombre, $apellidos, $foto, $contraseña)
    {

        $mensaje = "";
        $nombreArchivo = $foto['name'];
        $rutaArchivo = "../vista/imagenesPersonal/" . $nombreArchivo;
        $extension = substr($nombreArchivo, -4);
        $url =  "vista/imagenesPersonal/" . $nombreArchivo;


        if (($extension == ".jpg" || $extension == ".JPG") || ($extension == ".png" || $extension == ".PNG") || ($extension == "jpng"  || $extension == "JPNG")) {

            if (move_uploaded_file($foto["tmp_name"], $rutaArchivo)) {

                try {
                    $objRespuesta = conexion::conectar()->prepare("INSERT INTO personal(documento,nombre,apellidos,foto,contraseña) VALUES (:documento,:nombre,:apellidos,:foto,:contrasena)");
                    $objRespuesta->bindParam(":documento", $documento, PDO::PARAM_STR);
                    $objRespuesta->bindParam(":nombre", $nombre, PDO::PARAM_STR);
                    $objRespuesta->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
                    $objRespuesta->bindParam(":foto", $url, PDO::PARAM_STR);
                    $objRespuesta->bindParam(":contrasena", $contraseña, PDO::PARAM_STR);


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

    public static function mdlModificarPersonal(){







    }

    public static function mdlEliminarPersonal($idPersonal,$deleteFoto){

        $mensaje = "";
        if ($deleteFoto == "null") {

            try {
                $objRespuesta = conexion::conectar()->prepare("DELETE FROM personal WHERE idPersonal='$idPersonal'");
               
        
                if ($objRespuesta->execute()) {
                    $mensaje = "ok";
                }else {
                    $mesnaje = "error";
                }
        
                $objRespuesta = null;

            } catch (Exception $e) {
               
                $mesanje = $e;
    
            }
        }else {
            if (unlink("../".$deleteFoto)) { 
            
           
                try {
                    $objRespuesta = conexion::conectar()->prepare("DELETE FROM personal WHERE idPersonal='$idPersonal'");
                   
            
                    if ($objRespuesta->execute()) {
                        $mensaje = "ok";
                    }else {
                        $mesnaje = "error";
                    }
            
                    $objRespuesta = null;
                } catch (Exception $e) {
                   
                    $mesanje = $e;
        
                }
            } 
            else { 
    
                $mensaje = "No se puede eliminar la foto";
            }
        }
       

        
      
        
        return $mensaje;


    }


    public static function mdlModificarSinCambioFoto($idPersonal,$documento,$nombre,$apellidos,$foto,$contraseña){


        $mensaje =  "";
        

        try {

            $objRespuesta = conexion::conectar()->prepare("UPDATE personal SET documento='$documento',nombre='$nombre',apellidos='$apellidos', foto='$foto',contraseña='$contraseña' WHERE idPersonal='$idPersonal'");

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


    public static function mdlModificarConCambioFoto($idPersonal,$documento,$nombre,$apellidos,$foto,$fotoAnterior,$contraseña){

        $mensaje = "";
        $nombreArchivo = $foto['name'];
        $rutaArchivo = "../vista/imagenesPersonal/" . $nombreArchivo;
        $extension = substr($nombreArchivo, -4);
        $url =  "vista/imagenesPersonal/" . $nombreArchivo;

        if (($extension == ".jpg" || $extension == ".JPG") || ($extension == ".png" || $extension == ".PNG") || ($extension == "jpng"  || $extension == "JPNG")) {
            
            if (move_uploaded_file($foto["tmp_name"], $rutaArchivo)) {

                if (unlink("../".$fotoAnterior)){

                    try {
        
                        $objRespuesta = conexion::conectar()->prepare("UPDATE personal SET documento='$documento',nombre='$nombre',apellidos='$apellidos', foto='$url',contraseña='$contraseña' WHERE idPersonal='$idPersonal'");
            
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
                    
                    $mensaje = "nose puede cambiar la foto del registro";
                }
        
            }
        }
        
        
        return $mensaje;


        
    }
}
