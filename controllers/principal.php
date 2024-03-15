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
}
