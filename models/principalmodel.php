<?php
class PrincipalModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }



    function Cargar_Total_Completados($parametros)
    {

        try {

            $FECHA_INI = $parametros["FECHA_INI"];
            $FECHA_FIN = $parametros["FECHA_FIN"];

            $items = [];
            $query = $this->db->connect()->prepare("SELECT 
                    COUNT(*) as TOTAL_COMPLETADOS
                    from wsoqajmy_chatbot.tb_chatbot tc 
                    where DATE(tc.Fecha_de_Consulta) BETWEEN :INICIO AND :FIN

                    ");
            $query->bindParam(":INICIO", $FECHA_INI, PDO::PARAM_STR);
            $query->bindParam(":FIN", $FECHA_FIN, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $res = array(
                    "success" => true,
                    "data" => $result,
                    "message" => "",
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            } else {
                $err = $query->errorInfo();
                $res = array(
                    "success" => false,
                    "data" => [],
                    "message" => $err,
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            }
        } catch (PDOException $e) {
            $res = array(
                "success" => false,
                "data" => [],
                "message" => $e,
                "sql" => ""
            );
            echo json_encode($res);
            exit();
        }
    }

    function Cargar_Total_Errores($parametros)
    {

        try {

            $FECHA_INI = $parametros["FECHA_INI"];
            $FECHA_FIN = $parametros["FECHA_FIN"];

            $items = [];
            $query = $this->db->connect()->prepare("SELECT 
                    COUNT(*) as TOTAL_ERRORES
                    from wsoqajmy_chatbot.tb_chatbot tc 
                    where campo_1 like '%Error%'
                    and DATE(tc.Fecha_de_Consulta) BETWEEN :INICIO AND :FIN

                    ");
            $query->bindParam(":INICIO", $FECHA_INI, PDO::PARAM_STR);
            $query->bindParam(":FIN", $FECHA_FIN, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $res = array(
                    "success" => true,
                    "data" => $result,
                    "message" => "",
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            } else {
                $err = $query->errorInfo();
                $res = array(
                    "success" => false,
                    "data" => [],
                    "message" => $err,
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            }
        } catch (PDOException $e) {
            $res = array(
                "success" => false,
                "data" => [],
                "message" => $e,
                "sql" => ""
            );
            echo json_encode($res);
            exit();
        }
    }

    function Cargar_Total_Aprobados($parametros)
    {

        try {

            $FECHA_INI = $parametros["FECHA_INI"];
            $FECHA_FIN = $parametros["FECHA_FIN"];

            $items = [];
            $query = $this->db->connect()->prepare("SELECT 
                        COUNT(*) as TOTAL_APROBADOS
                        from wsoqajmy_chatbot.tb_chatbot tc 
                        where campo_1 = 'Cliente Si Califica'
                    and DATE(tc.Fecha_de_Consulta) BETWEEN :INICIO AND :FIN

                    ");
            $query->bindParam(":INICIO", $FECHA_INI, PDO::PARAM_STR);
            $query->bindParam(":FIN", $FECHA_FIN, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $res = array(
                    "success" => true,
                    "data" => $result,
                    "message" => "",
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            } else {
                $err = $query->errorInfo();
                $res = array(
                    "success" => false,
                    "data" => [],
                    "message" => $err,
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            }
        } catch (PDOException $e) {
            $res = array(
                "success" => false,
                "data" => [],
                "message" => $e,
                "sql" => ""
            );
            echo json_encode($res);
            exit();
        }
    }

    function Cargar_Total_Rechazados($parametros)
    {

        try {

            $FECHA_INI = $parametros["FECHA_INI"];
            $FECHA_FIN = $parametros["FECHA_FIN"];

            $items = [];
            $query = $this->db->connect()->prepare("SELECT 
                    COUNT(*) as TOTAL_RECHAZADOS
                    from wsoqajmy_chatbot.tb_chatbot tc 
                    where campo_1 like '%Solicitud Rechazada%'
                    and DATE(tc.Fecha_de_Consulta) BETWEEN :INICIO AND :FIN

                    ");
            $query->bindParam(":INICIO", $FECHA_INI, PDO::PARAM_STR);
            $query->bindParam(":FIN", $FECHA_FIN, PDO::PARAM_STR);


            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $res = array(
                    "success" => true,
                    "data" => $result,
                    "message" => "",
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            } else {
                $err = $query->errorInfo();
                $res = array(
                    "success" => false,
                    "data" => [],
                    "message" => $err,
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            }
        } catch (PDOException $e) {
            $res = array(
                "success" => false,
                "data" => [],
                "message" => $e,
                "sql" => ""
            );
            echo json_encode($res);
            exit();
        }
    }

    function Cargar_Monto_Aprobado($parametros)
    {

        try {

            $FECHA_INI = $parametros["FECHA_INI"];
            $FECHA_FIN = $parametros["FECHA_FIN"];

            $items = [];
            $query = $this->db->connect()->prepare("SELECT 
                    SUM(campo_2 * 36) as MONTO_APROBADO
                    from wsoqajmy_chatbot.tb_chatbot tc 
                    where campo_1 = 'Cliente Si Califica'
                    and DATE(tc.Fecha_de_Consulta) BETWEEN :INICIO AND :FIN

                    ");
            $query->bindParam(":INICIO", $FECHA_INI, PDO::PARAM_STR);
            $query->bindParam(":FIN", $FECHA_FIN, PDO::PARAM_STR);


            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $res = array(
                    "success" => true,
                    "data" => $result,
                    "message" => "",
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            } else {
                $err = $query->errorInfo();
                $res = array(
                    "success" => false,
                    "data" => [],
                    "message" => $err,
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            }
        } catch (PDOException $e) {
            $res = array(
                "success" => false,
                "data" => [],
                "message" => $e,
                "sql" => ""
            );
            echo json_encode($res);
            exit();
        }
    }

    function Estado_formulario($parametros)
    {

        try {

            $FECHA_INI = $parametros["FECHA_INI"];
            $FECHA_FIN = $parametros["FECHA_FIN"];

            $items = [];
            $query = $this->db->connect()->prepare("SELECT 
                        'Completadas' as estado,
                        COUNT(*) as total
                        FROM wsoqajmy_chatbot.tb_chatbot tc 
                        WHERE DATE(tc.Fecha_de_Consulta) BETWEEN :INICIO AND :FIN

                    UNION ALL
                        SELECT 
                        'Incompletas' as estado,
                        COUNT(*) 
                        FROM consultas_ganga cg2 
                        where cedula not in (SELECT numero_identidad from wsoqajmy_chatbot.tb_chatbot tc)
                        and DATE(cg2.fecha) BETWEEN :INICIO AND :FIN

                    UNION ALL
                    SELECT
                        'Iniciadas' as estado,
                        COUNT(*) as total
                        from logconsultas cg
                        where DATE(cg.fecha_creado) BETWEEN :INICIO AND :FIN
                        and desdedondeconsulta = 'GANGA'
                    ");
            $query->bindParam(":INICIO", $FECHA_INI, PDO::PARAM_STR);
            $query->bindParam(":FIN", $FECHA_FIN, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $res = array(
                    "success" => true,
                    "data" => $result,
                    "message" => "",
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            } else {
                $err = $query->errorInfo();
                $res = array(
                    "success" => false,
                    "data" => [],
                    "message" => $err,
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            }
        } catch (PDOException $e) {
            $res = array(
                "success" => false,
                "data" => [],
                "message" => $e,
                "sql" => ""
            );
            echo json_encode($res);
            exit();
        }
    }

    function Estado_de_credito($parametros)
    {

        try {

            $FECHA_INI = $parametros["FECHA_INI"];
            $FECHA_FIN = $parametros["FECHA_FIN"];

            $items = [];
            $query = $this->db->connect()->prepare("SELECT 
                    'Aprobados' as estado,
                    COUNT(*) as total
                    from wsoqajmy_chatbot.tb_chatbot tc 
                    where campo_1 = 'Cliente Si Califica'
                    and DATE(tc.Fecha_de_Consulta) BETWEEN :INICIO AND :FIN
                    UNION ALL
                    select 
                    'Rechazados' as estado,
                    COUNT(*) as total
                    from wsoqajmy_chatbot.tb_chatbot tc 
                    where campo_1 like '%Solicitud Rechazada%'
                    and DATE(tc.Fecha_de_Consulta) BETWEEN :INICIO AND :FIN
                    ");
            $query->bindParam(":INICIO", $FECHA_INI, PDO::PARAM_STR);
            $query->bindParam(":FIN", $FECHA_FIN, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $res = array(
                    "success" => true,
                    "data" => $result,
                    "message" => "",
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            } else {
                $err = $query->errorInfo();
                $res = array(
                    "success" => false,
                    "data" => [],
                    "message" => $err,
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            }
        } catch (PDOException $e) {
            $res = array(
                "success" => false,
                "data" => [],
                "message" => $e,
                "sql" => ""
            );
            echo json_encode($res);
            exit();
        }
    }

    
    function Numero_Conversaciones($parametros)
    {
        try {

            $FECHA_INI = $parametros["FECHA_INI"];
            $FECHA_FIN = $parametros["FECHA_FIN"];

            $items = [];
            $query = $this->db->connect()->prepare("SELECT
                COUNT(*) as NUMERO
                from logconsultas cg
                where DATE(cg.fecha_creado) BETWEEN :INICIO AND :FIN
                and desdedondeconsulta = 'GANGA'
                ");
            $query->bindParam(":INICIO", $FECHA_INI, PDO::PARAM_STR);
            $query->bindParam(":FIN", $FECHA_FIN, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $res = array(
                    "success" => true,
                    "data" => $result,
                    "message" => "",
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            } else {
                $err = $query->errorInfo();
                $res = array(
                    "success" => false,
                    "data" => [],
                    "message" => $err,
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            }
        } catch (PDOException $e) {
            $res = array(
                "success" => false,
                "data" => [],
                "message" => $e,
                "sql" => ""
            );
            echo json_encode($res);
            exit();
        }
    }

    function Datos_General($parametros)
    {
        try {

            $FECHA_INI = $parametros["FECHA_INI"];
            $FECHA_FIN = $parametros["FECHA_FIN"];

            $items = [];
            $query = $this->db->connect()->prepare("SELECT  * from consultas_ganga cg 
                left join wsoqajmy_chatbot.tb_chatbot tc 
                on tc.ID_Transaccion = cg.id_unico 
                where DATE(cg.fecha) BETWEEN :INICIO AND :FIN
                order by tc.id
                ");
            $query->bindParam(":INICIO", $FECHA_INI, PDO::PARAM_STR);
            $query->bindParam(":FIN", $FECHA_FIN, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $res = array(
                    "success" => true,
                    "data" => $result,
                    "message" => "",
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            } else {
                $err = $query->errorInfo();
                $res = array(
                    "success" => false,
                    "data" => [],
                    "message" => $err,
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            }
        } catch (PDOException $e) {
            $res = array(
                "success" => false,
                "data" => [],
                "message" => $e,
                "sql" => ""
            );
            echo json_encode($res);
            exit();
        }
    }








    function Cargar_Cantidad_Total($parametros)
    {
        $fecha_ini = $parametros["fecha_ini"];
        $fecha_fin = $parametros["fecha_fin"];

        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT
                    'DEMO' as CONSULTA,
                    cedula, 
                    IFNULL(numero,'') as numero ,
                    fecha as fecha_consulta,
                    IFNULL(URL_CONSULTA,'') as API,
                    IFNULL(comercio,'') as comercio,
                    IFNULL(datos,'') as datos
                    from encript_agua ea 
                    where DATE(fecha) BETWEEN :fechaini and :fechafin
                UNION
                select 
                    'SOLID' as CONSULTA,
                    cedula,
                    IFNULL(numero,'')as numero,
                    fecha_consulta,
                    IFNULL(api,'') as API,
                    IFNULL(mercado,'') as comercio,
                    IFNULL(datos,'') as datos 
                    from creditossolicitados c   
                where DATE(c.fecha_consulta) BETWEEN :fechaini and :fechafin
            ");
            $query->bindParam(":fechaini", $fecha_ini, PDO::PARAM_STR);
            $query->bindParam(":fechafin", $fecha_fin, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $res = array(
                    "success" => true,
                    "data" => $result,
                    "message" => "",
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            } else {
                $err = $query->errorInfo();
                $res = array(
                    "success" => false,
                    "data" => [],
                    "message" => $err,
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            }
        } catch (PDOException $e) {
            $res = array(
                "success" => false,
                "data" => [],
                "message" => $e,
                "sql" => ""
            );
            echo json_encode($res);
            exit();
        }
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

    function Cargar_Cant_Consultas($param)
    {
        // $fecha_ini = $parametros["fecha_ini"];
        // $fecha_fin = $parametros["fecha_fin"];

        try {
            $fecha_ini = $param["fecha_ini"];
            $fecha_fin = $param["fecha_fin"];

            $SQL = "SELECT 
            id_unico,
            cedula ,
            numero ,
            fecha_consulta ,
            archivo ,
            datos
            FROM creditossolicitados
            WHERE
                DATE(fecha_consulta) BETWEEN :inicio and :fin
                ";

            $query = $this->db->connect()->prepare($SQL);
            $query->bindParam(":inicio", $fecha_ini, PDO::PARAM_STR);
            $query->bindParam(":fin", $fecha_fin, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $res = array(
                    "success" => true,
                    "data" => $result,
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            } else {
                $err = $query->errorInfo();
                $res = array(
                    "success" => false,
                    "data" => $err,
                    "sql" => ""
                );
                echo json_encode($res);
                exit();
            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }
    }

    function Cargar_Cant_Dispositivo($parametros)
    {
        // $fecha_ini = $parametros["fecha_ini"];
        // $fecha_fin = $parametros["fecha_fin"];

        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT 
            dispositivo 
            from creditos_solicitados cs 
            where cs.estado = 1
            union ALL
            select 
            dispositivo 
            from solo_telefonos st
            where estado = 1
            and numero not in(select numero from creditos_solicitados cs where estado= 1)
            ");
            // $query->bindParam(":fechaini", $fecha_ini, PDO::PARAM_STR);
            // $query->bindParam(":fechafin", $fecha_fin, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $ARRA = [];
                foreach ($result as $row) {
                    $disp = $row["dispositivo"];
                    if (preg_match('/\(([^;]+);/', $disp, $matches)) {
                        $tipo_dispositivo = $matches[1];
                        array_push($ARRA, array(
                            "tipo" => $tipo_dispositivo
                        ));
                    } else {
                        array_push($ARRA, array(
                            "tipo" => "NO ENCONTRADO"
                        ));
                    }
                }

                echo json_encode($ARRA);
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
