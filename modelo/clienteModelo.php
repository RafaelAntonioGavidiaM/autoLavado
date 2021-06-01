<?php


include_once "conexion.php";

class clienteModelo{

   public static function mdlInsertar ($documento, $nombre,$apellido,$direccion,$telefono,$email)

   {
       $mensaje ="";

       try {
           $objRespuesta = Conexion::conectar()->prepare("INSERT INTO dueño (documento, nombre, apellidos, direccion,telefono,email) VALUES (:documento,:nombre,:apellido,:direccion,:telefono,:email)");
           $objRespuesta -> bindParam(":documento",$documento,PDO::PARAM_STR);
           $objRespuesta -> bindParam(":nombre",$nombre,PDO::PARAM_STR);
           $objRespuesta -> bindParam(":apellido",$apellido,PDO::PARAM_STR);
           $objRespuesta -> bindParam(":direccion",$direccion,PDO::PARAM_STR);
           $objRespuesta -> bindParam(":telefono",$telefono,PDO::PARAM_STR);
           $objRespuesta -> bindParam(":email",$email,PDO::PARAM_STR);

           if ($objRespuesta->execute()) {
            $mensaje = "ok";
        } else {
            $mensaje = "error";
        }
        $objRespuesta=null;


       } catch (Exception $e){

            $mensaje= $e;
       } 
       
       return $mensaje;
   }
   
     public static function mdlListarTodos(){

        $objRespuesta= Conexion::conectar()->prepare("SELECT * FROM dueño");
        $objRespuesta->execute();
        $objRespuesta =$objRespuesta ->fetchAll();
        $objRespuesta = null;
        return $listaCliente;
     }


}