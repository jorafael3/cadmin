<?php

$url_cargar_grafico_linea_horas = constant('URL') . 'principal/cargar_grafico_linea_horas/';
$url_cargar_grafico_por_edad = constant('URL') . 'principal/cargar_grafico_por_edad/';

?>

<script>
    var url_cargar_grafico_linea_horas = '<?php echo $url_cargar_grafico_linea_horas ?>';
    var url_cargar_grafico_por_edad = '<?php echo $url_cargar_grafico_por_edad ?>';


    function Cargar_reporte() {
        let fecha_ini = $("#GRL_FECHA").val();
        // let fecha_fin = $("#fecha_fin").val();
        // let tipo = $("#flexRadioDefault1").is(":checked") == true ? 1 : 0;

        let param = {
            fecha_ini: moment(fecha_ini).format("YYYY-MM-DD"),
            fecha_fin: moment(fecha_ini).format("YYYY-MM-DD"),
        }
        // console.log('param: ', param);


        AjaxSendReceiveData(url_cargar_grafico_linea_horas, param, function(x) {
            console.log('x: ', x);
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

            console.log('chartData: ', chartData);
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
            console.log('x: ', x);
            Cargar_Por_Edad_grafico(x)
        })
    }

    function Cargar_Por_Edad_grafico(data) {
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("chartdiv_Cargar_Por_Edad_grafico", am4charts.XYChart);

            chart.data = data;

            chart.padding(40, 40, 40, 40);

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.dataFields.category = "rango_edad";
            categoryAxis.renderer.minGridDistance = 60;
            // categoryAxis.renderer.inversed = true;
            categoryAxis.renderer.grid.template.disabled = true;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;
            valueAxis.extraMax = 0.1;
            //valueAxis.rangeChangeEasing = am4core.ease.linear;
            //valueAxis.rangeChangeDuration = 1500;

            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.categoryX = "rango_edad";
            series.dataFields.valueY = "cantidad_personas";
            series.tooltipText = "{valueY.value}"
            series.columns.template.strokeOpacity = 0;
            series.columns.template.column.cornerRadiusTopRight = 10;
            series.columns.template.column.cornerRadiusTopLeft = 10;
            //series.interpolationDuration = 1500;
            //series.interpolationEasing = am4core.ease.linear;
            var labelBullet = series.bullets.push(new am4charts.LabelBullet());
            labelBullet.label.verticalCenter = "bottom";
            labelBullet.label.dy = -10;
            labelBullet.label.text = "{values.valueY.workingValue.formatNumber('#.')}";

            chart.zoomOutButton.disabled = true;

            // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
            series.columns.template.adapter.add("fill", function(fill, target) {
                return chart.colors.getIndex(target.dataItem.index);
            });

            // setInterval(function() {
            //     am4core.array.each(chart.data, function(item) {
            //         item.visits += Math.round(Math.random() * 200 - 100);
            //         item.visits = Math.abs(item.visits);
            //     })
            //     chart.invalidateRawData();
            // }, 2000)

            // categoryAxis.sortBySeries = series;

        }); // end am4core.ready()
    }
    Cargar_Por_Edad()

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