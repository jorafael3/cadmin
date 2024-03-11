<?php

$url_cargar_reporte = constant('URL') . 'reportes/Cargar_Reporte/';

?>

<script>
    var url_cargar_reporte = '<?php echo $url_cargar_reporte ?>';


    function Cargar_reporte() {
        let fecha_ini = $("#fecha_ini").val();
        let fecha_fin = $("#fecha_fin").val();
        let tipo = $("#flexRadioDefault1").is(":checked") == true ? 1 : 0;

        let param = {
            fecha_ini: moment(fecha_ini).format("YYYY-MM-DD"),
            fecha_fin: moment(fecha_fin).format("YYYY-MM-DD"),
            tipo: tipo
        }
        console.log('param: ', param);


        AjaxSendReceiveData(url_cargar_reporte, param, function(x) {
            console.log('x: ', x);

            let data = x.filter(i => new Date(moment(i.fecha_creado).format("YYYY-MM-DD")) >= new Date(moment(fecha_ini).format("YYYY-MM-DD"))
                && new Date(moment(i.fecha_creado).format("YYYY-MM-DD")) <= new Date(moment(fecha_fin).format("YYYY-MM-DD")));
            console.log('data: ', data);
            if (tipo == true) {
                Tabla_reporte(data);
            } else {
                Tabla_reporte_incompleto(data);
            }

        })

    }
    Cargar_reporte();

    function Tabla_reporte(data) {
        $('#Tabla_reporte').empty();
        var table = $('#Tabla_reporte').DataTable({
            destroy: true,
            data: data,
            dom: 'Brtip',
            responsive: true,
            deferRender: true,
            "pageLength": 20,
            "paging": true,
            buttons: ['excel'],
            "order": [
                [0, "asc"],
            ],
            // "columnDefs": [{
            //     "width": "5%",
            //     "targets": 0
            // }, {
            //     "width": "20%",
            //     "targets": 1
            // }, {
            //     "width": "1%",
            //     "targets": 3
            // }],
            columns: [{
                    data: "fecha_creado",
                    title: "fecha creado"
                }, {
                    data: "numero",
                    title: "numero"
                },
                {
                    data: "cedula",
                    title: "cedula",
                }, {
                    data: "nombre_cliente",
                    title: "nombre cliente",
                }, {
                    data: "codigo_dactilar",
                    title: "codigo dactilar",
                },
                {
                    data: "fecha_nacimiento",
                    title: "fecha nacimiento",
                },
                {
                    data: "fecha_nacimiento",
                    title: "edad",
                    render: function(x) {
                        const fechaActual = moment();
                        const fechaNacimiento = moment(x, "DD/MM/YYYY"); // Formatear x como "DD/MM/YYYY"
                        const edad = fechaActual.diff(fechaNacimiento, 'years');
                        return edad
                    }
                }

            ],

            "createdRow": function(row, data, index) {
                // $('td', row).eq(1).addClass('bg-warning bg-opacity-50');
            }

        }).clear().rows.add(data).draw();
    }

    function Tabla_reporte_incompleto(data) {
        $('#Tabla_reporte').empty();
        var table = $('#Tabla_reporte').DataTable({
            destroy: true,
            data: data,
            dom: 'Brtip',
            responsive: true,
            deferRender: true,
            "pageLength": 20,
            "paging": true,
            buttons: ['excel'],
            "order": [
                [0, "asc"],
            ],
            // "columnDefs": [{
            //     "width": "5%",
            //     "targets": 0
            // }, {
            //     "width": "20%",
            //     "targets": 1
            // }, {
            //     "width": "1%",
            //     "targets": 3
            // }],
            columns: [{
                    data: "fecha_creado",
                    title: "fecha creado"
                }, {
                    data: "numero",
                    title: "numero"
                }

            ],

            "createdRow": function(row, data, index) {
                // $('td', row).eq(1).addClass('bg-warning bg-opacity-50');
            }

        }).clear().rows.add(data).draw();
    }

    function AjaxSendReceiveData(url, data, callback) {
        var xmlhttp = new XMLHttpRequest();
        $.blockUI({
            message: '<div class="d-flex justify-content-center align-items-center"><p class="mr-50 mb-0">Cargando ...</p> <div class="spinner-grow spinner-grow-sm text-white" role="status"></div> </div>',
            css: {
                backgroundColor: 'transparent',
                color: '#fff',
                border: '0'
            },
            overlayCSS: {
                opacity: 0.5
            }
        });

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);
                callback(data);
            }
        }
        xmlhttp.onload = () => {
            $.unblockUI();
            // 
        };
        xmlhttp.onerror = function() {
            $.unblockUI();
        };
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }
</script>