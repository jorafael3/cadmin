<?php


class Reportes extends Controller
{

    function __construct()
    {

        parent::__construct();
        //$this->view->render('principal/index');
        //echo "nuevo controlaodr";
    }
    
    function render()
    {
        $this->view->render('principal/reportes');
    }

    function Cargar_Reporte()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->Cargar_Reporte($array);
    }

    function Generar_ciudades()
    {
        $array = json_decode(file_get_contents("php://input"), true);
        $function = $this->model->Generar_ciudades($array);
    }
}
