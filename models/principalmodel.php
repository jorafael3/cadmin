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
}
