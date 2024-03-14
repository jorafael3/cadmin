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
                cs.*,
                st.terminos
                from creditos_solicitados cs
                left join solo_telefonos st 
                on st.numero = cs.numero 
                where cs.estado = 1 and st.estado = 1
                -- where date(fecha_creado) between :fecha_ini and :fecha_fin
                -- group by 
                -- date(fecha_creado)
                order by cs.fecha_creado asc";
            } else {

            $sql = "SELECT 
            st.fecha_creado,
            cs.cedula,
            st.numero,
            cs.correo,
            st.terminos
            from solo_telefonos st 
            left join creditos_solicitados cs 
            on cs.numero = st.numero
            where st.estado = 1
            and st.numero not in (select numero from creditos_solicitados cs2 where estado = 1)
            order by st.fecha_creado desc
           ";
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
