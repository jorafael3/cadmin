<?php
class PrincipalModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }


    function cargar_grafico_linea_horas($parametros)
    {
        $fecha_ini = $parametros["fecha_ini"];
        $fecha_fin = $parametros["fecha_fin"];

        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT * from solo_telefonos st 
            where estado  = 1
            and date(fecha_creado) between :fechaini and :fechafin
            ");
            $query->bindParam(":fechaini", $fecha_ini, PDO::PARAM_STR);
            $query->bindParam(":fechafin", $fecha_fin, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($result);
                exit();
            } else {
                $err = $query->errorInfo();
                echo json_encode($err);
                exit();
            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }
    }

    function cargar_grafico_por_edad($parametros)
    {
        // $fecha_ini = $parametros["fecha_ini"];
        // $fecha_fin = $parametros["fecha_fin"];

        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT 
            CONCAT(FLOOR(edad/5)*5, ' - ', FLOOR(edad/5)*5 + 4) AS rango_edad,
            COUNT(*) AS cantidad_personas
            FROM 
                (
                    SELECT 
                        TIMESTAMPDIFF(YEAR, STR_TO_DATE(cs.fecha_nacimiento, '%d/%m/%Y'), CURDATE()) AS edad
                    FROM 
                        creditos_solicitados cs
                ) AS subconsulta
            GROUP BY 
                FLOOR(edad/5);
            ");
            // $query->bindParam(":fechaini", $fecha_ini, PDO::PARAM_STR);
            // $query->bindParam(":fechafin", $fecha_fin, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($result);
                exit();
            } else {
                $err = $query->errorInfo();
                echo json_encode($err);
                exit();
            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }
    }

    function cargar_grafico_por_localidad($parametros)
    {
        // $fecha_ini = $parametros["fecha_ini"];
        // $fecha_fin = $parametros["fecha_fin"];

        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT 
                localidad,
                count(localidad)  as cantidad
                from creditos_solicitados cs 
                where estado  = 1
                group by localidad
                order by cantidad desc
            ");
            // $query->bindParam(":fechaini", $fecha_ini, PDO::PARAM_STR);
            // $query->bindParam(":fechafin", $fecha_fin, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($result);
                exit();
            } else {
                $err = $query->errorInfo();
                echo json_encode($err);
                exit();
            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }
    }
}
