<?php

require 'views/header.php';
date_default_timezone_set('America/Guayaquil');
$current = date("Y-m-01");
$currentDateTime = date("Y-m-d");

?>


<style>
    #legend {
        width: 200px;
        height: 450px;
        border: 1px solid #eee;
        margin-left: 10px;
        float: left;
    }

    #legend .legend-item {
        margin: 10px;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
    }

    #legend .legend-item .legend-value {
        font-size: 12px;
        font-weight: normal;
        margin-left: 22px;
    }

    #legend .legend-item .legend-marker {
        display: inline-block;
        width: 12px;
        height: 12px;
        border: 1px solid #ccc;
        margin-right: 10px;
    }

    #legend .legend-item.disabled .legend-marker {
        opacity: 0.5;
        background: #ddd;
    }
</style>



<div class="col-12 p-1">
    <div class="row">

        <div class="col-12">
            <div class="card shadow p-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <input id="fecha_ini" type="date" class="form-control" value="<?php echo $current ?>">
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <input id="fecha_fin" type="date" class="form-control" value="<?php echo $currentDateTime ?>">
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <button onclick="Cargar_Cantidad_Total()" class="btn btn-primary">Cargar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="col-12 p-1">
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card p-2">
                <div class="card-body">
                    <h4 class="text-start fw-bold">Consultas realizadas</h4>
                    <h6 class="text-muted">Total de consultas</h6>
                    <h1 class="fw-bold m-4" style="font-size: 40px;" id="CANTIDAD_CONSULTAS"></h1>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card p-2">
                <div class="card-body">
                    <h4 class="text-start fw-bold text-danger">Consultas con errores</h4>
                    <h6 class="text-muted">Cedula no valida...</h6>
                    <h1 class="fw-bold m-4" style="font-size: 40px;" id="CANTIDAD_CONSULTAS_ERRORES"></h1>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card p-2">
                <div class="card-body">
                    <h4 class="text-start fw-bold">Consultas Demografica</h4>
                    <h6 class="text-muted">Solo demografico</h6>
                    <h1 class="fw-bold m-4" style="font-size: 40px;" id="CANTIDAD_CONSULTAS_DEMOGRAFICA"></h1>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card p-2">
                <div class="card-body">
                    <h4 class="text-start fw-bold">Consultas solidario</h4>
                    <h6 class="text-muted">demografico + solidario</h6>
                    <h1 class="fw-bold m-4" style="font-size: 40px;" id="CANTIDAD_CONSULTAS_SOLIDARIO"></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 p-1">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="p-1 text-center">Rango de edad</h2>
                    <button class="btn btn-sm btn-success" id="BTN_EDAD_DEMO">DEMOGRAFICO</button>
                    <button class="btn btn-sm btn-info" id="BTN_EDAD_SOLI">SOLIDARIO</button>
                    <div style="height: 350px;" id="chartdiv_Cargar_Por_Edad_grafico"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-body">

                    <h2 class="p-1 text-center">Por localidad</h2>
                    <button class="btn btn-sm btn-success" id="BTN_LOC_DEMO">DEMOGRAFICO</button>
                    <button class="btn btn-sm btn-info" id="BTN_LOC_SOLI">SOLIDARIO</button>
                    <button class="btn btn-sm" id="BTN_LOC_PROV">Provincia</button>
                    <button class="btn btn-sm" id="BTN_LOC_CIUD">Ciudad</button>
                    <div style="height: 350px;" id="chartdiv_Cargar_Por_Edad_localidad"></div>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-12 p-1">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="col-12">
                        <div class="col-12 mb-2">
                            <button class="btn btn-sm btn-success" id="BTN_LIN_DEMO">DEMOGRAFICO</button>
                            <button class="btn btn-sm btn-info" id="BTN_LIN_SOLI">SOLIDARIO</button>
                            <button id="BTN_MES" class="btn btn-sm btn-light">Rango en curso</button>
                            <button id="BTN_DIA" class="btn btn-sm btn-light">Por dia</button>

                            <div id="SECC_DIA" style="display: none;">
                                <h5>Seleccione dia</h5>
                                <input type="text" id="fecha" class="form-control mt-2">
                            </div>


                            <!-- <input onchange=" Cargar_reporte()" id="GRL_FECHA" type="date" class="form-control" value="<?php echo $currentDateTime ?>"> -->
                        </div>
                        <div style="height: 400px;" id="chartdiv"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src='funciones/functions.js'></script>
<?php require 'views/footer.php'; ?>
<?php require 'funciones/dasboard_js.php'; ?>

<script>

</script>