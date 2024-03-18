<?php

require 'views/header.php';
date_default_timezone_set('America/Guayaquil');

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
<div class="row ">

    <div class="col-6 p-1">
        <div class="card box-content bordered primary">
            <div class="card-body">
                <div class="col-12">
                    <h2 class="p-2 text-start ">Consultas realizadas</h2>
                    <h1 class="fw-bold m-4" style="font-size: 100px;" id="CANTIDAD_CONSULTAS"></h1>
                    <div style="height: 300px;" id="Cargar_Cant_Consultas_Grafico"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-4 p-1">
        <div class="card box-content bordered primary">
            <div class="card-body">
                <div class="col-12">
                    <div class="statistics-box with-icon p-5">
                        <i class="ico fab fa-apple text-inverse"></i>
                        <h2 class="counter fw-bold" style="font-size: 50px;" id="MAC"></h2>
                    </div>

                </div>
            </div>
        </div>
        <div class="card box-content bordered primary">
            <div class="card-body">
                <div class="col-12">

                    <div class="statistics-box with-icon p-5">
                        <i class="ico fab fa-android text-success"></i>
                        <h2 class="counter fw-bold" style="font-size: 50px;" id="ANDROID"></h2>
                    </div>

                </div>
            </div>
        </div>
        <div class="card box-content bordered primary">
            <div class="card-body">
                <div class="col-12">
                    <div class="statistics-box with-icon p-5">
                        <i class="ico fab fa-windows text-primary"></i>
                        <h2 class="counter fw-bold" style="font-size: 50px;" id="WIN"></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 p-1">
        <div class="card">
            <div class="card-body">
                <div class="col-12">
                    <h2 class="p-1 text-center">Rango de edad</h2>
                    <div style="height: 500px;" id="chartdiv_Cargar_Por_Edad_grafico"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 p-1">
        <div class="card">
            <div class="card-body">
                <div class="col-12">
                    <h2 class="p-1 text-center">localidad</h2>
                    <div class="row">
                        <div class="col-12">
                            <div style="height: 500px;" id="chartdiv_Cargar_Por_Edad_localidad"></div>

                        </div>
                        <!-- <div class="col-4">
                            <div id="legend"></div>

                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 p-1">
        <div class="card">
            <div class="card-body">

                <div class="col-12">
                    <div class="col-4">
                        <input onchange=" Cargar_reporte()" id="GRL_FECHA" type="date" class="form-control" value="<?php echo $currentDateTime ?>">
                    </div>
                    <div style="height: 500px;" id="chartdiv"></div>
                </div>
            </div>
        </div>
    </div>

</div>


<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<?php require 'views/footer.php'; ?>
<?php require 'funciones/dasboard_js.php'; ?>

<script>

</script>