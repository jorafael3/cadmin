<?php

require 'views/header.php';
require 'funciones/toplocalesjs.php';
date_default_timezone_set('America/Guayaquil');

$currentDateTime = date("Y-m-d");

?>

<div class="col-12">
    <div class="card ">
        <div class="card-header ">
            <h3 class="fw-bold">Reportes</h3>
        </div>
        <div class="card-body p-5">
            <div class="row">
                <div class="col-3">
                    <input id="fecha_ini" type="date" class="form-control" value="<?php echo $currentDateTime ?>">
                </div>
                <div class="col-3">
                    <input id="fecha_fin" type="date" class="form-control" value="<?php echo $currentDateTime ?>">
                </div>

                <div class="col-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Solicitudes Completas
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Solicitudes incompletas
                        </label>
                    </div>
                </div>
                <div class="col-3">
                    <button onclick="Cargar_reporte()" class="btn btn-primary"><i class="bi bi-box-arrow-in-down fs-1 fw-bold"></i></button>
                </div>
                <div class="col-12 pt-3">
                    <table id="Tabla_reporte" style="width: 100%; font-size: 14px; font-weight: bold;" class="table-hover table-bordered table-striped">

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'views/footer.php'; ?>
<?php require 'funciones/reportes_js.php'; ?>