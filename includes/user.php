<?php
require_once 'libs/database.php';

//include_once 'models/usuario.php';
class User extends Model
{

    public $nombre;
    public $username;


    function uss($user, $contra)
    {
        try {

            $sql = "SELECT * FROM usuario
            WHERE usuario = :usuario and pass = :pass
            and estado = 1";

            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(":usuario", $user, PDO::PARAM_STR);
            $query->bindParam(":pass", $contra, PDO::PARAM_STR);
            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    $_SESSION['iniciosesion'] = true;
                    $_SESSION['Usuario'] = $result[0]["usuario"];
                    $_SESSION['usuarioID'] = $result[0]["id"];
                    $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                    return 1;
                } else {
                    return 0;
                }
                // echo json_encode($result);
                // exit();
            } else {
                $err = $query->errorInfo();
                return 0;
            }
        } catch (PDOException $e) {
            // print_r($query->errorInfo());
            return 0;
        }
    }

    function userExist($user, $pass)
    {

        //$items = [];
        $correo = $user;


        try {
            $usu = "";
            $tipo = "";
            $Nivel = "";
            $query = $this->db->connect()->prepare("select * from inv_users");
            $query->execute();
            $result = $query->fetchAll();
            if ($query->rowCount()) {
                try {
                    foreach ($result as $row) {
                        $usu   = $row['Usuario'];
                        $tipo = $row['Tipo'];
                        $nivel = $row['Nivel'];
                        $ID = $row['usuarioID'];
                    }
                    // echo ($usu);
                    //echo ($estado);
                    if ($usu == "ERROR" or $usu == null or $nivel == "ERROR") {
                        return  false;
                    } else {
                        $_SESSION['iniciosesion'] = true;
                        $_SESSION['Usuario'] = $usu;
                        $_SESSION['Email'] = $user;
                        $_SESSION['Tipo'] = $tipo;
                        $_SESSION['usuarioID'] = $ID;
                        $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
                        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];


                        return true;
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                echo "error";
                return false;
                //exit();
            }
        } catch (PDOException $e) {
            // echo $e->getMessage();
        }
    }



    public function Intentos()
    {
        try {
            $usuarioId = "";
            $query = $this->db->connect()->prepare("{ CALL CSD_Login_user (?,?)}");
            $query->bindParam(1, $usuarioId, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $e) {
        }
    }



    function closeSession()
    {

        echo "adsdawdawd";
    }
}
