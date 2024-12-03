<?php

$url_cargar_grafico_linea_horas = constant('URL') . 'principal/cargar_grafico_linea_horas/';
$url_cargar_grafico_por_edad = constant('URL') . 'principal/cargar_grafico_por_edad/';
$url_cargar_grafico_por_localidad = constant('URL') . 'principal/cargar_grafico_por_localidad/';
$url_Cargar_Cant_Consultas = constant('URL') . 'principal/Cargar_Cant_Consultas/';
$url_Cargar_Cant_Dispositivo = constant('URL') . 'principal/Cargar_Cant_Dispositivo/';


$url_Cargar_Cantidad_Total = constant('URL') . 'principal/Cargar_Cantidad_Total/';



?>

<script>
    var url_cargar_grafico_linea_horas = '<?php echo $url_cargar_grafico_linea_horas ?>';
    var url_cargar_grafico_por_edad = '<?php echo $url_cargar_grafico_por_edad ?>';
    var url_cargar_grafico_por_localidad = '<?php echo $url_cargar_grafico_por_localidad ?>';
    var url_Cargar_Cant_Consultas = '<?php echo $url_Cargar_Cant_Consultas ?>';
    var url_Cargar_Cant_Dispositivo = '<?php echo $url_Cargar_Cant_Dispositivo ?>';

    var url_Cargar_Cantidad_Total = '<?php echo $url_Cargar_Cantidad_Total ?>';



    //** CANTODAD DE CONSULTAS */
    var DATA_FULL = [];
    var DATOS_ARRAY_COMPLETOS = [];
    var DATOS_ARRAY_INCOMPLETOS = [];


    var DATOS_DEMO = [];
    var DATOS_SOLI = [];

    var ARRAY_DATA_DEMO = [];
    var ARRAY_DATA_SOLI = [];




    //***** */

    function Cargar_Cantidad_Total() {
        let fecha_ini = $("#fecha_ini").val();
        let fecha_fin = $("#fecha_fin").val();
        let param = {
            fecha_ini: fecha_ini,
            fecha_fin: fecha_fin,
        }
        AjaxSendReceiveData(url_Cargar_Cantidad_Total, param, function(x) {

            if (x.success) {
                let datos = x.data
                let datos_demo = datos.filter(i => i.CONSULTA == 'DEMO');
                DATOS_DEMO = datos_demo;
                let datos_soli = datos.filter(i => i.CONSULTA == 'SOLID');
                DATOS_SOLI = datos_soli;
                PARSEAR_DATA(DATOS_DEMO, DATOS_SOLI);
                setTimeout(() => {
                    CARTILLA_TOTAL();
                    CARTILLA_ERRORES();
                    CARTILLA_DEMO();
                    CARTILLA_SOLIDA()
                    POR_EDAD();
                    POR_LOCALIDAD();
                    LINEA_TIEMPO();
                    POR_COMERCIO()
                }, 500);

            } else {
                Mensaje("Error al cargar los datos, intentelo en un momento", "", "error")
            }
        });

    }

    function PARSEAR_DATA(DEMO, SOLI) {
        ARRAY_DATA_DEMO = [];
        ARRAY_DATA_SOLI = [];
        DEMO.map(function(x) {
            if (x["datos"].includes("Error") || x["datos"] == '') {

            } else {
                let d = JSON.parse(x.datos);
                ARRAY_DATA_DEMO.push(d[0])
            }
        });

        SOLI.map(function(x) {
            if (x["datos"] == []) {

            } else {
                let d = JSON.parse(x.datos);
                ARRAY_DATA_SOLI.push(d)
            }
        });


        



    }

    Cargar_Cantidad_Total();


    function CARTILLA_TOTAL() {
        let cant = DATOS_DEMO.length + DATOS_SOLI.length
        $("#CANTIDAD_CONSULTAS").text(cant);
    }

    function CARTILLA_ERRORES() {
        let cant = DATOS_DEMO
        let con = 0;
        cant.map(function(x) {
            if (x["datos"].includes("Error")) {
                con = con + 1
            }

        });

        $("#CANTIDAD_CONSULTAS_ERRORES").text(con);

    }

    function CARTILLA_DEMO() {
        let cant = DATOS_DEMO.length
        $("#CANTIDAD_CONSULTAS_DEMOGRAFICA").text(cant);
    }

    function CARTILLA_SOLIDA() {
        let cant = DATOS_SOLI.length
        $("#CANTIDAD_CONSULTAS_SOLIDARIO").text(cant);
    }


    var EDAD_CAMBIO = 0

    $("#BTN_EDAD_DEMO").on("click", function(x) {
        EDAD_CAMBIO = 0;
        POR_EDAD()
    });

    $("#BTN_EDAD_SOLI").on("click", function(x) {
        EDAD_CAMBIO = 1;
        POR_EDAD()
    })


    function POR_EDAD() {

        let DATOS = ARRAY_DATA_DEMO;

        if (EDAD_CAMBIO == 1) {
            DATOS = ARRAY_DATA_SOLI;
        }
        let ARRAY = [];
        DATOS.map(function(x) {
            // x = JSON.parse(x)
            let edad = x.SOCIODEMOGRAFICO[0]["Edad"];
            let found = ARRAY.find(function(item) {
                return item.edad === edad;
            });
            if (found) {
                found.cantidad += 1;
            } else {
                let b = {
                    edad: edad,
                    cantidad: 1
                };
                ARRAY.push(b);
            }
        });

        ARRAY.sort((a, b) => a.edad - b.edad);

        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("chartdiv_Cargar_Por_Edad_grafico", am4charts.XYChart3D);

            chart.data = ARRAY;

            chart.padding(40, 40, 40, 40);

            let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "edad";
            categoryAxis.renderer.labels.template.rotation = 270;
            categoryAxis.renderer.labels.template.hideOversized = false;
            categoryAxis.renderer.minGridDistance = 20;
            categoryAxis.renderer.labels.template.horizontalCenter = "right";
            categoryAxis.renderer.labels.template.verticalCenter = "middle";
            categoryAxis.tooltip.label.rotation = 270;
            categoryAxis.tooltip.label.horizontalCenter = "right";
            categoryAxis.tooltip.label.verticalCenter = "middle";

            let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.title.text = "";
            valueAxis.title.fontWeight = "bold";

            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries3D());
            series.dataFields.valueY = "cantidad";
            series.dataFields.categoryX = "edad";
            series.name = "cantidad_personas";
            series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = .8;

            var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 2;
            columnTemplate.strokeOpacity = 1;
            columnTemplate.stroke = am4core.color("#FFFFFF");

            columnTemplate.adapter.add("fill", function(fill, target) {
                return chart.colors.getIndex(target.dataItem.index);
            })

            columnTemplate.adapter.add("stroke", function(stroke, target) {
                return chart.colors.getIndex(target.dataItem.index);
            })

            chart.cursor = new am4charts.XYCursor();
            chart.cursor.lineX.strokeOpacity = 0;
            chart.cursor.lineY.strokeOpacity = 0;

        }); // end am4core.ready()
    }


    var LOCALIDAD_CAMBIO = 0
    var PROVINCIA = 1;
    var CIUDAD = 0;

    $("#BTN_LOC_DEMO").on("click", function(x) {
        LOCALIDAD_CAMBIO = 0;
        POR_LOCALIDAD()
    });

    $("#BTN_LOC_SOLI").on("click", function(x) {
        LOCALIDAD_CAMBIO = 1;
        POR_LOCALIDAD()
    })

    $("#BTN_LOC_PROV").on("click", function(x) {
        PROVINCIA = 1;
        CIUDAD = 0;
        POR_LOCALIDAD()
    });

    $("#BTN_LOC_CIUD").on("click", function(x) {
        PROVINCIA = 0;
        CIUDAD = 1;
        POR_LOCALIDAD()
    })

    function POR_LOCALIDAD() {
        let DATOS = ARRAY_DATA_DEMO;

        if (LOCALIDAD_CAMBIO == 1) {
            DATOS = ARRAY_DATA_SOLI;
        }
        let ARRAY = [];

        DATOS.map(function(x) {

            let lugar = x.SOCIODEMOGRAFICO[0]["LUGAR_DOM_PROVINCIA"];
            if (CIUDAD == 1) {
                lugar = x.SOCIODEMOGRAFICO[0]["LUGAR_DOM_CIUDAD"];
            }

            let found = ARRAY.find(function(item) {
                return item.localidad === lugar;
            });
            if (found) {
                found.cantidad += 1;
            } else {
                let b = {
                    localidad: lugar.trim(),
                    cantidad: 1
                };
                ARRAY.push(b);
            }
        });
        ARRAY.sort((a, b) => b.cantidad - a.cantidad);

        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv_Cargar_Por_Edad_localidad", am4charts.PieChart3D);

            // Add data
            chart.data = ARRAY
            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries3D());
            pieSeries.dataFields.value = "cantidad";
            pieSeries.dataFields.category = "localidad";
            pieSeries.slices.template.stroke = am4core.color("#fff");
            pieSeries.slices.template.strokeOpacity = 1;

            pieSeries.ticks.template.disabled = true;
            pieSeries.alignLabels = false;
            pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}% ({value})";
            pieSeries.labels.template.radius = am4core.percent(-40);
            pieSeries.labels.template.fill = am4core.color("white");
            // This creates initial animation
            pieSeries.hiddenState.properties.opacity = 1;
            pieSeries.hiddenState.properties.endAngle = -90;
            pieSeries.hiddenState.properties.startAngle = -90;

            chart.hiddenState.properties.radius = am4core.percent(0);

            // Configurar la leyenda
            chart.legend = new am4charts.Legend();
            chart.legend.position = "right";
            chart.legend.scrollable = true;
            chart.legend.maxHeight = 400;
            chart.legend.labels.template.text = "({cantidad})[bold]{name}[/]";
        });

    }

    function POR_COMERCIO() {
        let ARRAY = [];
        let DATOS = DATOS_DEMO;
        DATOS.map(function(x) {
            let lugar = x.comercio;
            if (lugar == '') {
                lugar = "SIN DEFINIR"
            }
            let found = ARRAY.find(function(item) {
                return item.comercio === lugar;
            });
            if (found) {
                found.cantidad += 1;
            } else {
                let b = {
                    comercio: lugar.trim(),
                    cantidad: 1
                };
                ARRAY.push(b);
            }
        });
        console.log('ARRAY: ', ARRAY);
        ARRAY.sort((a, b) => a.cantidad - b.cantidad);

        am4core.ready(function() {
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv_Cargar_Por_comercio", am4charts.XYChart);
            chart.scrollbarX = new am4core.Scrollbar();
            chart.data = ARRAY
            // Themes begin
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "comercio";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;
            categoryAxis.renderer.labels.template.horizontalCenter = "right";
            categoryAxis.renderer.labels.template.verticalCenter = "middle";
            categoryAxis.renderer.labels.template.rotation = 270;
            categoryAxis.tooltip.disabled = true;
            categoryAxis.renderer.minHeight = 110;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.minWidth = 50;

            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.sequencedInterpolation = true;
            series.dataFields.valueY = "cantidad";
            series.dataFields.categoryX = "comercio";
            series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
            series.columns.template.strokeWidth = 0;

            series.tooltip.pointerOrientation = "vertical";

            series.columns.template.column.cornerRadiusTopLeft = 10;
            series.columns.template.column.cornerRadiusTopRight = 10;
            series.columns.template.column.fillOpacity = 0.8;

            // on hover, make corner radiuses bigger
            var hoverState = series.columns.template.column.states.create("hover");
            hoverState.properties.cornerRadiusTopLeft = 0;
            hoverState.properties.cornerRadiusTopRight = 0;
            hoverState.properties.fillOpacity = 1;

            series.columns.template.adapter.add("fill", function(fill, target) {
                return chart.colors.getIndex(target.dataItem.index);
            });

            // Cursor
            chart.cursor = new am4charts.XYCursor();

        }); // end am4core.ready()
    }





    var LINEA_CAMBIO = 0;
    var MES = 1;
    var DIA = 0;

    $("#BTN_LIN_DEMO").on("click", function(x) {
        LINEA_CAMBIO = 0;
        LINEA_TIEMPO()
    })

    $("#BTN_LIN_SOLI").on("click", function(x) {
        LINEA_CAMBIO = 1;
        LINEA_TIEMPO()
    })

    $("#BTN_DIA").on("click", function(x) {
        MES = 0;
        DIA = 1;
        $("#SECC_DIA").show(50);
        LINEA_TIEMPO()
    })

    $("#BTN_MES").on("click", function(x) {
        MES = 1;
        DIA = 0;
        $("#SECC_DIA").hide();
        LINEA_TIEMPO()
    })

    function LINEA_TIEMPO() {

        let DATOS = DATOS_DEMO;

        if (LINEA_CAMBIO == 1) {
            DATOS = DATOS_SOLI;
        }

        let ARRAY = [];
        let DIAS = [];
        DATOS.map(function(x) {
            let lugar = x.fecha_consulta;
            lugar = moment(lugar).format("YYYY-MM-DD");
            let found = ARRAY.find(function(item) {
                return item.date === lugar;
            });
            if (found) {
                found.cantidad += 1;
            } else {
                let b = {
                    date: lugar.trim(),
                    cantidad: 1
                };
                ARRAY.push(b);
                DIAS.push(parseInt(moment(lugar).format("DD")));
            }
        });
        console.log('ARRAY: ', ARRAY);

        flatpickr("#fecha", {
            dateFormat: "Y-m-d",
            disable: [
                // Deshabilita días específicos
                function(date) {
                    // Lista de días permitidos
                    const allowedDays = DIAS;
                    return !allowedDays.includes(date.getDate());
                }
            ],
            locale: {
                firstDayOfWeek: 1 // Configura el primer día de la semana (opcional)
            },
            onChange: function(selectedDates, dateStr, instance) {

                ARRAY = [];
                let dataf = DATOS.filter(item => moment(item.fecha_consulta).format("YYYY-MM-DD") == dateStr)

                dataf.map(function(x) {
                    let lugar = x.fecha_consulta;
                    lugar = moment(lugar).format("YYYY-MM-DDTHH:00:00");

                    let found = ARRAY.find(function(item) {
                        return item.date === lugar;
                    });
                    if (found) {
                        found.cantidad += 1;
                    } else {
                        let b = {
                            date: lugar.trim(),
                            cantidad: 1
                        };
                        ARRAY.push(b);
                    }
                });

                GRAFICO_MES(ARRAY);
                // selectedDates es un array de fechas seleccionadas
                // dateStr es la fecha seleccionada en formato de cadena
                // instance es la instancia de Flatpickr

                // if (selectedDates.length > 0) {
                //     const selectedDate = selectedDates[0];
                //     alert("Fecha seleccionada: " + selectedDate.toLocaleDateString());
                // }
            }
        });

        if (MES == 1) {
            GRAFICO_MES(ARRAY)
        }

    }

    function GRAFICO_MES(ARRAY) {
        am4core.ready(function() {
            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            // Add data
            chart.data = ARRAY;

            // Set input format for the dates
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd HH:mm:ss";

            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "cantidad";
            series.dataFields.dateX = "date";
            series.tooltipText = "{cantidad}"
            series.strokeWidth = 2;
            series.minBulletDistance = 15;

            // Drop-shaped tooltips
            series.tooltip.background.cornerRadius = 20;
            series.tooltip.background.strokeOpacity = 0;
            series.tooltip.pointerOrientation = "vertical";
            series.tooltip.label.minWidth = 40;
            series.tooltip.label.minHeight = 40;
            series.tooltip.label.textAlign = "middle";
            series.tooltip.label.textValign = "middle";

            // Make bullets grow on hover
            var bullet = series.bullets.push(new am4charts.CircleBullet());
            bullet.circle.strokeWidth = 2;
            bullet.circle.radius = 4;
            bullet.circle.fill = am4core.color("#fff");

            var bullethover = bullet.states.create("hover");
            bullethover.properties.scale = 1.3;

            // Make a panning cursor
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.behavior = "panXY";
            chart.cursor.xAxis = dateAxis;
            chart.cursor.snapToSeries = series;

            // Create vertical scrollbar and place it before the value axis
            chart.scrollbarY = new am4core.Scrollbar();
            chart.scrollbarY.parent = chart.leftAxesContainer;
            chart.scrollbarY.toBack();

            // Create a horizontal scrollbar with previe and place it underneath the date axis
            chart.scrollbarX = new am4charts.XYChartScrollbar();
            chart.scrollbarX.series.push(series);
            chart.scrollbarX.parent = chart.bottomAxesContainer;

            // dateAxis.start = 0.79;
            dateAxis.keepSelection = true;
        });
    }

    function GRAFICO_DIAS(ARRAY) {
        am4core.ready(function() {

            // Aplicar el tema animado
            am4core.useTheme(am4themes_animated);

            // Crear una instancia de gráfico
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            // Crear un eje de fecha (X Axis)
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.grid.template.location = 0;
            dateAxis.dateFormats.setKey("hour", "HH:mm");
            dateAxis.periodChangeDateFormats.setKey("hour", "HH:mm");
            dateAxis.baseInterval = {
                timeUnit: "hour",
                count: 1
            };

            // Crear un eje de valores (Y Axis)
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // Crear una serie de datos
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "cantidad";
            series.dataFields.dateX = "date";
            series.tooltipText = "{cantidad}";

            // Agregar datos a la serie
            series.data = ARRAY;
            // Habilitar el cursor y el scroll
            chart.cursor = new am4charts.XYCursor();
            chart.scrollbarX = new am4core.Scrollbar();

            // Animar la serie en la carga
            series.appear(1000);
            chart.appear(1000, 100);

        }); // am4core.ready()
    }
</script>