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
        $listaCliente =$objRespuesta ->fetchAll();
        $objRespuesta = null;
        return $listaCliente;
     }

     public static function mdlEditar($idDueño,$documento,$nombre,$apellidos,$direccion,$telefono,$email){
       

        $mensaje = "";
        try {
            $objRespuesta = Conexion :: conectar()->prepare("UPDATE dueño SET documento ='$documento', nombre= '$nombre', apellidos= '$apellidos',direccion ='$direccion', telefono='$telefono', email = '$email' WHERE idDueño='$idDueño'");          
            
            if ($objRespuesta->execute()) {
                $mensaje = "ok";
            } else {
                $mensaje = "error";
            }

            $objRespuesta=null;
        } catch (Exception $e) {
            $mensaje = $e;
        }

        return $mensaje;  
             
       
     }

     public static function mdlEliminar($idDueño){
          
         $mensaje ="";
         try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE From dueño WHERE idDueño='$idDueño'");
            

            if ($objRespuesta->execute()) {
                $mensaje = "ok";
            } else {
                $mensaje = "error";
            }

            $objRespuesta=null;
        } catch (Exception $e) {
            $mensaje = $e;
        }

        return $mensaje;
     }


}