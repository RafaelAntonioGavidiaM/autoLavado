<?php

require_once "conexion.php";
class lavadoModelo
{

    public static function mdlCargarDuenos()
    {

        $objConuslta = conexion::conectar()->prepare("SELECT carro.idCarro,carro.modelo,carro.idDueño,dueño.nombre,dueño.apellidos,carro.color,carro.placa from carro inner join dueño on carro.idDueño=dueño.idDueño ");

        $objConuslta->execute();

        $lista = $objConuslta->fetchAll();

        $objConuslta = null;

        return $lista;
    }

    public static function mdlInsertar($fecha, $idCarro, $idPersonal, float $valorPagar)
    {

        $objPromocion = lavadoModelo::mdlComprobarPromocion($idCarro);
        $numerolavadas = $objPromocion[0];
        $numerolavadas += 1;
        $cumplePromocion = $numerolavadas % 6;

        $valorPagar = 0;

        if ($cumplePromocion == 0) {
            $valorPagar = 0;
        } else {
            $valorPagar = 8000;
        }







        $mensaje = "";
        try {

            $objConsulta = conexion::conectar()->prepare("INSERT INTO lavado(fecha,idCarro,idPersonal,valorPagar) VALUES (:fecha,:idCarro,:idPersonal,:valorPagar)");
            $objConsulta->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $objConsulta->bindParam(":idCarro", $idCarro, PDO::PARAM_INT);
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

    public static function mdlCargarTabla()
    {



        $objConsulta = conexion::conectar()->prepare("SELECT l.idlavado,l.fecha,c.idCarro,c.modelo,c.placa,p.idPersonal,p.nombre,p.apellidos,l.valorPagar from lavado as l inner join carro as c on c.idCarro=l.idCarro inner join personal as p on p.idPersonal=l.idPersonal");
        $objConsulta->execute();
        $lista = $objConsulta->fetchAll();
        $objConsulta = null;
        return $lista;
    }

    public static function mdlCargarTablaInformePorCarroPromocion($idCarro)
    {



        $objConsulta = conexion::conectar()->prepare("SELECT l.idlavado,l.fecha,c.idCarro,c.modelo,c.placa,p.idPersonal,p.nombre,p.apellidos,l.valorPagar from lavado as l inner join carro as c on c.idCarro=l.idCarro inner join personal as p on p.idPersonal=l.idPersonal where c.idCarro=:idCarro and l.valorPagar=0");
        $objConsulta->bindParam(":idCarro", $idCarro);
        $objConsulta->execute();
        $lista = $objConsulta->fetchAll();
        $objConsulta = null;
        return $lista;
    }

    public static function mdlCargarTablaInformePorCarro($idCarro)
    {



        $objConsulta = conexion::conectar()->prepare("SELECT l.idlavado,l.fecha,c.idCarro,c.modelo,c.placa,p.idPersonal,p.nombre,p.apellidos,l.valorPagar from lavado as l inner join carro as c on c.idCarro=l.idCarro inner join personal as p on p.idPersonal=l.idPersonal where c.idCarro=:idCarro and l.valorPagar=8000");
        $objConsulta->bindParam(":idCarro", $idCarro);
        $objConsulta->execute();
        $lista = $objConsulta->fetchAll();
        $objConsulta = null;
        return $lista;
    }

    public static function mdlCargarTablaId($idLavado)
    {

        $objConsulta = conexion::conectar()->prepare("SELECT l.idlavado,l.fecha,c.idCarro,c.modelo,c.placa,p.idPersonal,p.nombre,p.apellidos,l.valorPagar from lavado as l inner join carro as c on c.idCarro=l.idCarro inner join personal as p on p.idPersonal=l.idPersonal where idLavado=:idLavado");
        $objConsulta->bindParam(":idLavado", $idLavado);
        $objConsulta->execute();
        $lista = $objConsulta->fetch();
        $objConsulta = null;
        return $lista;
    }


    


    public static function mdlComprobarPromocion($idCarro) // comprobará si el vehiculo tiene promocion
    {
        $objConsulta = conexion::conectar()->prepare("SELECT  count(idLavado) as cuenta from lavado where idCarro=:idCarro");
        $objConsulta->bindParam(":idCarro", $idCarro, PDO::PARAM_INT);
        $objConsulta->execute();
        $lista = $objConsulta->fetch();
        $objConsulta = null;
        return $lista;
    }



    public static function mdlModificar($idLavado, $fecha, $idCarro, $idPersonal)
    {

        $objPromocion = lavadoModelo::mdlComprobarPromocion($idCarro);
        $numerolavadas = $objPromocion[0];
        $numerolavadas += 1;
        $cumplePromocion = $numerolavadas % 6;

        $valorPagar = 0;

        if ($cumplePromocion == 0) {
            $valorPagar = 0;
        } else {
            $valorPagar = 8000;
        }

        $mensaje = "";
        try {

            $objConsulta = conexion::conectar()->prepare("UPDATE lavado set fecha=:fecha,idCarro=:idCarro,idPersonal=:idPersonal,valorPagar=:valorPagar where idLavado=:idLavado");
            $objConsulta->bindParam(":fecha", $fecha, PDO::PARAM_STR);
            $objConsulta->bindParam(":idCarro", $idCarro, PDO::PARAM_INT);
            $objConsulta->bindParam(":idPersonal", $idPersonal, PDO::PARAM_INT);
            $objConsulta->bindParam(":valorPagar", $valorPagar);
            $objConsulta->bindParam(":idLavado", $idLavado);




            if ($objConsulta->execute()) {
                $mensaje = "ok";
            } else {
                $mensaje = "error";
            }
        } catch (Exception $e) {
            $mensaje = $e;
        }
        $objConsulta = null;

        return $mensaje;
    }


    public static function mdlEliminar($idLavado)
    {

        $mensaje = "";
        try {
            $objConsulta = conexion::conectar()->prepare("DELETE FROM lavado WHERE idLavado=:idLavado");
            $objConsulta->bindParam(":idLavado", $idLavado);
            if ($objConsulta->execute()) {
                $mensaje = "ok";
            } else {
                $mensaje = "error";
            }
        } catch (Exception $e) {
            $mensaje = $e;
        }
        $objConsulta = null;

        return $mensaje;
    }
}
