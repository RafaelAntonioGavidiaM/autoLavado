<?php

require_once "conexion.php";

class loginModelo{


    public static function mdlLoguear($usuario,$contraseña){

        $objConsulta = conexion::conectar()->prepare("SELECT idPersonal from personal where documento=:user and contraseña=:pswd");
        $objConsulta->bindParam(":user",$usuario,PDO::PARAM_STR);
        $objConsulta->bindParam(":pswd",$contraseña,PDO::PARAM_STR);

        $objConsulta->execute();

        $lista=$objConsulta->fetch();

        $objConsulta=null;

        return $lista;





    }

    public static function mdlConsultarUsuarioLogueado($idUsuario){
        $objConsulta = conexion::conectar()->prepare("SELECT * from personal where idPersonal=:id");
        $objConsulta->bindParam(":id",$idUsuario,PDO::PARAM_INT);
      

        $objConsulta->execute();

        $lista=$objConsulta->fetch();

        $objConsulta=null;

        return $lista;




    }
}

