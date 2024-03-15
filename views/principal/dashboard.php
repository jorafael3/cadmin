<?php

require 'views/header.php';
date_default_timezone_set('America/Guayaquil');

$currentDateTime = date("Y-m-d");

?>

<div class="col-12">

    <div class="card">
        <div class="card-body">

            <div class="col-6">
                <div style="height: 500px;" id="chartdiv_Cargar_Por_Edad_grafico"></div>
            </div>
            <div class="col-12">
                <div class="col-4">
                    <input onchange=" Cargar_reporte()" id="GRL_FECHA" type="date" class="form-control" value="<?php echo $currentDateTime ?>">
                </div>
                <div style="height: 500px;" id="chartdiv"></div>
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