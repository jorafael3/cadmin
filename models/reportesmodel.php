<?php
class ReportesModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }


    function Cargar_Reporte($parametros)
    {
        $fechaIni = $parametros["fecha_ini"];
        $fechaFin = $parametros["fecha_ini"];
        $tipo = $parametros["tipo"];

        try {
            $items = [];

            if ($tipo == 1) {

                $sql = "SELECT  
            *
            from creditos_solicitados cs
            -- where date(fecha_creado) between :fecha_ini and :fecha_fin
            -- group by 
            -- date(fecha_creado)
            order by fecha_creado asc";
            } else {

                $sql = "SELECT 
            st.fecha_creado,
            st.numero,
            count(cc.cantidad) as cant_consultas
            from solo_telefonos st
            left join cantidad_consultas cc 
            on cc.numero = st.numero
            where st.numero not in (select numero from creditos_solicitados cs where estado = 1)
            -- and date(st.fecha_creado) between :fecha_ini and :fecha_fin
            group by st.numero";
            }



            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(":fecha_ini", $fechaIni, PDO::PARAM_STR);
            $query->bindParam(":fecha_fin", $fechaFin, PDO::PARAM_STR);

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
