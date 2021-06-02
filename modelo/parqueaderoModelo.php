<?php

require_once "conexion.php";

class parqueaderoModelo
{

    public static function mdlConsultarCarros()
    {

        $objConsulta = conexion::conectar()->prepare("select carro.idCarro,carro.modelo,carro.placa,dueño.nombre,dueño.apellidos from carro inner join dueño on carro.idDueño=dueño.idDueño");
        $objConsulta->execute();
        $lista = $objConsulta->fetchAll();

        $objConsulta = null;
        return $lista;
    }

    public static function mdlInsertarPaqueadero($fecha, $idCarro, $horaEntrada, $horaSalida, $tiempo, $idPersonal, float $valorPagar)
    {

        $mensaje = "";
        try {



            $objConsulta = conexion::conectar()->prepare("INSERT INTO parqueadero(fecha,idCarro,horaEntrada,horaSalida,tiempo,idPersonal,valorPagar) values (:fecha,:id,:horaEntrada,:horaSalida,:tiempo,:idPersonal,:valorPagar)");
            //$objConexion->bindParam(":id",$id,PDO::PARAM_INT);
            $objConsulta->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $objConsulta->bindParam(":id", $idCarro, PDO::PARAM_INT);
            $objConsulta->bindParam(":horaEntrada", $horaEntrada, PDO::PARAM_STR);
            $objConsulta->bindParam(":horaSalida", $horaSalida, PDO::PARAM_STR);
            $objConsulta->bindParam(":tiempo", $tiempo, PDO::PARAM_STR);
            $objConsulta->bindParam(":idPersonal", $idPersonal, PDO::PARAM_INT);
            $objConsulta->bindParam(":valorPagar", $valorPagar);

            if ($objConsulta->execute()) {
                $mensaje = "ok";
            } else {
                $mensaje = "error";
            }
        } catch (Exception $e) {
            $mensaje = $e;
        }

        return $mensaje;
    }


    public static function mdlConsultarTabla()
    {

        $objConsulta = conexion::conectar()->prepare("SELECT dueño.nombre as nombreDueño,dueño.apellidos as apellidosDueño,park.idParqueadero,park.fecha,car.idCarro,car.modelo,car.placa,park.horaEntrada,park.horaSalida,park.tiempo,personal.idPersonal,personal.nombre,personal.apellidos ,park.valorPagar from parqueadero as park inner join carro as car on park.idCarro=car.idCarro inner join personal on personal.idPersonal=park.idPersonal inner join dueño on dueño.idDueño=car.idDueño ");
        
        $objConsulta->execute();
        $lista = $objConsulta->fetchAll();

        $objConsulta = null;
        return $lista;
    }

    public static function mdlConsultarFactura($idParqueadero)
    {

        $objConsulta = conexion::conectar()->prepare("SELECT dueño.nombre as nombreDueño,dueño.apellidos as apellidosDueño,park.idParqueadero,park.fecha,car.idCarro,car.modelo,car.placa,park.horaEntrada,park.horaSalida,park.tiempo,personal.idPersonal,personal.nombre,personal.apellidos ,park.valorPagar from parqueadero as park inner join carro as car on park.idCarro=car.idCarro inner join personal on personal.idPersonal=park.idPersonal inner join dueño on dueño.idDueño=car.idDueño where park.idParqueadero=:idBuscar ");
        $objConsulta->bindParam(":idBuscar", $idParqueadero,PDO::PARAM_INT);

        $objConsulta->execute();
        $lista = $objConsulta->fetch();

        $objConsulta = null;
        return $lista;
    }

    public static function mdlModificar($idParqueadero, $fecha, $idCarro, $horaEntrada, $horaSalida, $tiempo, $idPersonal,float $valorPagar)
    {

        try {


            $objConsulta = conexion::conectar()->prepare("UPDATE parqueadero set fecha=:fecha,idCarro=:idCarro,horaEntrada=:horaEntrada,horaSalida=:horaSalida,tiempo=:tiempo,idPersonal=:idPersonal,valorPagar=:valorPagar where idParqueadero=:idParqueadero");
            $objConsulta->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $objConsulta->bindParam(":idCarro", $idCarro, PDO::PARAM_INT);
            $objConsulta->bindParam(":horaEntrada", $horaEntrada, PDO::PARAM_STR);
            $objConsulta->bindParam(":horaSalida", $horaSalida, PDO::PARAM_STR);
            $objConsulta->bindParam(":tiempo", $tiempo, PDO::PARAM_STR);
            $objConsulta->bindParam(":idPersonal", $idPersonal, PDO::PARAM_INT);
            $objConsulta->bindParam(":valorPagar", $valorPagar);
            $objConsulta->bindParam(":idParqueadero", $idParqueadero,PDO::PARAM_INT);


            if ($objConsulta->execute()) {
                $mensaje = "ok";
            } else {
                $mensaje = "error";
            }
        } catch (Exception $e) {
            $mensaje = $e;
        }

        return $mensaje;
    }
    
    public static function mdlEliminar($idEliminar){

        $mensaje="";
        try {


            $objConsulta = conexion::conectar()->prepare("DELETE FROM parqueadero where idParqueadero=:idParqueadero");
            $objConsulta->bindParam(":idParqueadero", $idEliminar,PDO::PARAM_INT);
            if ($objConsulta->execute()) {
                $mensaje = "ok";
            } else {
                $mensaje = "error";
            }
            
            

        } catch (Exception $e) {
            $mensaje=$e;

        }

        return $mensaje;

    }

}
