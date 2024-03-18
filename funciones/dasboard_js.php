<?php

$url_cargar_grafico_linea_horas = constant('URL') . 'principal/cargar_grafico_linea_horas/';
$url_cargar_grafico_por_edad = constant('URL') . 'principal/cargar_grafico_por_edad/';
$url_cargar_grafico_por_localidad = constant('URL') . 'principal/cargar_grafico_por_localidad/';
$url_Cargar_Cant_Consultas = constant('URL') . 'principal/Cargar_Cant_Consultas/';
$url_Cargar_Cant_Dispositivo = constant('URL') . 'principal/Cargar_Cant_Dispositivo/';

?>

<script>
    var url_cargar_grafico_linea_horas = '<?php echo $url_cargar_grafico_linea_horas ?>';
    var url_cargar_grafico_por_edad = '<?php echo $url_cargar_grafico_por_edad ?>';
    var url_cargar_grafico_por_localidad = '<?php echo $url_cargar_grafico_por_localidad ?>';
    var url_Cargar_Cant_Consultas = '<?php echo $url_Cargar_Cant_Consultas ?>';
    var url_Cargar_Cant_Dispositivo = '<?php echo $url_Cargar_Cant_Dispositivo ?>';

    //** CANTODAD DE CONSULTAS */

    function Cargar_Cant_Consultas() {

        AjaxSendReceiveData(url_Cargar_Cant_Consultas, [], function(x) {
            console.log('x: ', x);
            let suma = 0;
            x.map(function(y) {
                suma = suma + parseInt(y.cantidad)
            })
            console.log('suma: ', suma);
            $("#CANTIDAD_CONSULTAS").text(suma);
            Cargar_Cant_Consultas_Grafico(x)
        })
    }
    Cargar_Cant_Consultas()

    function Cargar_Cant_Consultas_Grafico(datos) {



        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("Cargar_Cant_Consultas_Grafico", am4charts.XYChart3D);

            chart.data = datos
            chart.padding(40, 40, 40, 40);

            let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "estado";
            categoryAxis.renderer.labels.template.rotation = 0;
            categoryAxis.renderer.labels.template.hideOversized = false;
            categoryAxis.renderer.minGridDistance = 20;
            categoryAxis.tooltip.label.rotation = 0;

            let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.title.text = "";
            valueAxis.title.fontWeight = "bold";

            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries3D());
            series.dataFields.valueY = "cantidad";
            series.dataFields.categoryX = "estado";
            series.name = "cantidad";
            series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = .8;
            chart.colors.list = [
                am4core.color("#52BE80"),
                am4core.color("#F4D03F"),
            ];

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

            // Agregar etiquetas de texto encima de las barras
            var labelBullet = series.bullets.push(new am4charts.LabelBullet());
            labelBullet.label.text = "{valueY}";
            labelBullet.label.dy = -10; // Ajuste de la posición vertical de la etiqueta
            labelBullet.label.truncate = false;
            labelBullet.label.hideOversized = false;
            labelBullet.label.fontSize = 30; // Ajuste del tamaño de la fuente
            labelBullet.label.fontWeight = "bold"; // Establecer negrita
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.lineX.strokeOpacity = 0;
            chart.cursor.lineY.strokeOpacity = 0;

        }); // end am4core.ready()
    }

    //*** POR DISPOSITOVO */

    function Cargar_Cant_Dispositivo() {

        AjaxSendReceiveData(url_Cargar_Cant_Dispositivo, [], function(x) {
            console.log('x: ', x);
            let wind = 0;
            let android = 0;
            let mac = 0;

            x.map(function(y) {
                let tipo = (y.tipo).toUpperCase()
                console.log('tipo: ', tipo);
                if (tipo == "LINUX") {
                    android = android + 1
                }
                if (tipo == "MACINTOSH") {
                    mac = mac + 1
                }
                if (tipo.includes("WINDOWS")) {
                    wind = wind + 1
                }
            })

            $("#MAC").text(mac);
            $("#ANDROID").text(android);
            $("#WIN").text(wind);

        })
    }
    Cargar_Cant_Dispositivo()

    //** POR LINEA DE TIEMPO */
    function Cargar_reporte() {
        let fecha_ini = $("#GRL_FECHA").val();
        // let fecha_fin = $("#fecha_fin").val();
        // let tipo = $("#flexRadioDefault1").is(":checked") == true ? 1 : 0;

        let param = {
            fecha_ini: moment(fecha_ini).format("YYYY-MM-DD"),
            fecha_fin: moment(fecha_ini).format("YYYY-MM-DD"),
        }
        // 


        AjaxSendReceiveData(url_cargar_grafico_linea_horas, param, function(x) {

            const groupedData = x.reduce((acc, curr) => {
                const date = new Date(curr.fecha_creado);
                const hour = date.getHours();
                const key = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()} ${hour}:00:00`;

                if (!acc[key]) {
                    acc[key] = [];
                }

                acc[key].push(curr);
                return acc;
            }, {});

            // Preparar datos para el gráfico
            const chartData = Object.keys(groupedData).map(key => {
                return {
                    date: new Date(key),
                    value: groupedData[key].length
                };
            });


            Grafico_linea_tiempo_horas(chartData)
        })

    }

    function Grafico_linea_tiempo_horas(chartData) {
        am4core.ready(function() {
            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            // Add data
            chart.data = chartData;

            // Set input format for the dates
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd HH:mm:ss";

            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "value";
            series.dataFields.dateX = "date";
            series.tooltipText = "{value}"
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

    Cargar_reporte();


    //******************************** */
    // POR EDAD

    function Cargar_Por_Edad() {

        AjaxSendReceiveData(url_cargar_grafico_por_edad, [], function(x) {

            Cargar_Por_Edad_grafico(x)
        })
    }

    function Cargar_Por_Edad_grafico(data) {
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("chartdiv_Cargar_Por_Edad_grafico", am4charts.XYChart3D);

            chart.data = data;

            chart.padding(40, 40, 40, 40);

            let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "rango_edad";
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
            series.dataFields.valueY = "cantidad_personas";
            series.dataFields.categoryX = "rango_edad";
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
    Cargar_Por_Edad()

    //******************************** */
    //* POR LOCALIDAD
    function Cargar_Por_Localidad() {

        AjaxSendReceiveData(url_cargar_grafico_por_localidad, [], function(x) {
            console.log('x: ', x);
            Cargar_Por_Localidad_grafico(x)
            // Cargar_Por_Edad_grafico(x)
        })
    }

    function Cargar_Por_Localidad_grafico(data) {
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv_Cargar_Por_Edad_localidad", am4charts.PieChart3D);

            // Add data
            chart.data = data
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
    Cargar_Por_Localidad()

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