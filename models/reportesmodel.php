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
                dr.*,
                de.*
                from creditos_solicitados cs
                left join Datos_Reconocimiento dr
                on dr.ID_UNICO  = cs.ID_UNICO 
                left join Datos_Empleo de 
                on de.ID_UNICO = cs.ID_UNICO
                where cs.API_SOL_ESTADO = 1
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

    function Generar_ciudades()
    {
        try {
            $items = [];


            $sql = "SELECT  
                cs.*
                from creditos_solicitados cs
                where cs.estado = 1
                order by cs.fecha_creado asc
                
                ";

            $query = $this->db->connect()->prepare($sql);
            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $AR = [];
                foreach ($result as $row) {
                    $cedula = trim($row["cedula"]);
                    $cedula_encr = trim($row["cedula_encr"]);
                    $d = $this->consulta_api_cedula($cedula_encr);
                    $CANT = $d[1][0]->CANT_DOM;
                    $DACTILAR = $d[1][0]->INDIVIDUAL_DACTILAR;
                    $FECHA_NACIM = $d[1][0]->FECHA_NACIM;
                    $sql2 = "UPDATE creditos_solicitados cs
                    SET 
                        localidad = :localidad,
                        fecha_nacimiento = :fecha_nacimiento,
                        codigo_dactilar = :codigo_dactilar,

                    where cs.cedula = :cedula
                    ";

                    $query2 = $this->db->connect()->prepare($sql2);
                    $query2->bindParam(":localidad", $CANT, PDO::PARAM_STR);
                    $query2->bindParam(":fecha_nacimiento", $FECHA_NACIM, PDO::PARAM_STR);
                    $query2->bindParam(":codigo_dactilar", $DACTILAR, PDO::PARAM_STR);
                    $query2->bindParam(":cedula", $cedula, PDO::PARAM_STR);
                    if ($query2->execute()) {

                    }

                    array_push($AR, $d);
                    // $row["META"] = "asdasd";
                }
                echo json_encode([$result,$AR]);
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

    function consulta_api_cedula($cedula_encr)
    {
        // $cedula_encr = "yt3TIGS4cvQQt3+q6iQ2InVubHr4hm4V7cxn1V3jFC0=";
        $old_error_reporting = error_reporting();
        // Desactivar los mensajes de advertencia
        error_reporting($old_error_reporting & ~E_WARNING);
        // Realizar la solicitud
        // Restaurar el nivel de informe de errores original

        try {
            $url = 'https://consultadatosapi.azurewebsites.net/api/GetDataBasica?code=Hp37f_WfqrsgpDyl8rP9zM1y-JRSJTMB0p8xjQDSEDszAzFu7yW3XA==&id=' . $cedula_encr . '&emp=SALVACERO&subp=DATOSCEDULA';
            // $url = 'https://apidatoscedula20240216081841.azurewebsites.net/api/GetData?code=FXs4nBycLJmBacJWuk_olF_7thXybtYRFDDyaRGKbnphAzFuQulUlA==&id=' . $cedula_encr . '&emp=SALVACERO&subp=DATOSCEDULA';
            try {
                // Realizar la solicitud
                $response = file_get_contents($url);
                error_reporting($old_error_reporting);
                if ($response === false) {
                    // $data = json_decode($response);
                    return [2, []];
                } else {
                    $data = json_decode($response);
                    if (isset($data->error)) {
                        return [0, $data->error, $cedula_encr];
                    } else {
                        if (count(($data->DATOS)) > 0) {
                            return [1, $data->DATOS];
                        } else {
                            return [0, $data->DATOS];
                        }
                    }
                }
            } catch (Exception $e) {
                // Capturar y manejar la excepción
                echo json_encode([0, "ssssss"]);
                exit();
            }
        } catch (Exception $e) {
            $e = $e->getMessage();
            echo json_encode($e);
            exit();
        }
    }
}
