<?php


class Principal extends Controller
{

    function __construct()
    {

        parent::__construct();
        //$this->view->render('principal/index');
        //echo "nuevo controlaodr";
    }

    function render()
    {
        $this->view->render('principal/dashboard');
    }


    function Cargar_Total_Completados()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->Cargar_Total_Completados($array);
    }

    function Cargar_Total_Errores()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->Cargar_Total_Errores($array);
    }

    function Cargar_Total_Aprobados()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->Cargar_Total_Aprobados($array);
    }

    
    function Cargar_Total_Rechazados()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->Cargar_Total_Rechazados($array);
    }

     
    function Cargar_Monto_Aprobado()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->Cargar_Monto_Aprobado($array);
    }

    function Estado_de_credito()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->Estado_de_credito($array);
    }






















    function Cargar_Cantidad_Total()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->Cargar_Cantidad_Total($array);
    }











    function cargar_grafico_linea_horas()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->cargar_grafico_linea_horas($array);
    }

    function cargar_grafico_por_edad()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->cargar_grafico_por_edad($array);
    }

    function cargar_grafico_por_localidad()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->cargar_grafico_por_localidad($array);
    }

    function Cargar_Cant_Consultas()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->Cargar_Cant_Consultas($array);
    }

    function Cargar_Cant_Dispositivo()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->Cargar_Cant_Dispositivo($array);
    }
}
