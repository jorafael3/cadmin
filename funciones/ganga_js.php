<?php

$url_Cargar_Total_Completados = constant('URL') . 'principal/Cargar_Total_Completados/';
$url_Cargar_Total_Errores = constant('URL') . 'principal/Cargar_Total_Errores/';
$url_Cargar_Total_Aprobados = constant('URL') . 'principal/Cargar_Total_Aprobados/';
$url_Cargar_Total_Rechazados = constant('URL') . 'principal/Cargar_Total_Rechazados/';
$url_Cargar_Monto_Aprobado = constant('URL') . 'principal/Cargar_Monto_Aprobado/';
$url_Estado_de_credito = constant('URL') . 'principal/Estado_de_credito/';

?>
<script>
    var url_Cargar_Total_Completados = '<?php echo $url_Cargar_Total_Completados ?>';
    var url_Cargar_Total_Errores = '<?php echo $url_Cargar_Total_Errores ?>';
    var url_Cargar_Total_Aprobados = '<?php echo $url_Cargar_Total_Aprobados ?>';
    var url_Cargar_Total_Rechazados = '<?php echo $url_Cargar_Total_Rechazados ?>';
    var url_Cargar_Monto_Aprobado = '<?php echo $url_Cargar_Monto_Aprobado ?>';

    var url_Estado_de_credito = '<?php echo $url_Estado_de_credito ?>';


    var FECHA_INI = "";
    var FECHA_INI = "";

    function Cargar() {

        FECHA_INI = $("#fecha_ini").val();
        FECHA_FIN = $("#fecha_fin").val();

        setTimeout(() => {
            Cargar_Total_Completados()
            Cargar_Total_Errores()
            Cargar_Total_Aprobados()
            Cargar_Total_Rechazados()
            Cargar_Monto_Aprobado()



            Estado_formulario()
            Estado_de_credito()
            Top5_ciudades()
            Estado_civil()
            Rango_edades()
            Top_salario()
            Trafico()
        }, 100);


    }
    Cargar()


    function Cargar_Total_Completados() {
        let param = {
            FECHA_INI: FECHA_INI,
            FECHA_FIN: FECHA_FIN
        }
        AjaxSendReceiveData(url_Cargar_Total_Completados, param, function(x) {

            if (x.success) {
                let datos = x.data;
                if (datos.length > 0) {
                    datos = datos[0]
                    $("#TOTAL_COMPLETADOS").text(datos.TOTAL_COMPLETADOS);
                } else {

                }
            } else {

            }
        });
    }

    function Cargar_Total_Errores() {
        let param = {
            FECHA_INI: FECHA_INI,
            FECHA_FIN: FECHA_FIN
        }
        AjaxSendReceiveData(url_Cargar_Total_Errores, param, function(x) {

            if (x.success) {
                let datos = x.data;
                if (datos.length > 0) {
                    datos = datos[0]
                    $("#TOTAL_ERRORES").text(datos.TOTAL_ERRORES);
                } else {

                }
            } else {

            }
        });
    }

    function Cargar_Total_Aprobados() {
        let param = {
            FECHA_INI: FECHA_INI,
            FECHA_FIN: FECHA_FIN
        }
        AjaxSendReceiveData(url_Cargar_Total_Aprobados, param, function(x) {

            if (x.success) {
                let datos = x.data;
                if (datos.length > 0) {
                    datos = datos[0]
                    $("#TOTAL_APROBADOS").text(datos.TOTAL_APROBADOS);
                } else {

                }
            } else {

            }
        });
    }

    function Cargar_Total_Rechazados() {
        let param = {
            FECHA_INI: FECHA_INI,
            FECHA_FIN: FECHA_FIN
        }
        AjaxSendReceiveData(url_Cargar_Total_Rechazados, param, function(x) {

            if (x.success) {
                let datos = x.data;
                if (datos.length > 0) {
                    datos = datos[0]
                    $("#TOTAL_RECHAZADOS").text(datos.TOTAL_RECHAZADOS);
                } else {

                }
            } else {

            }
        });
    }

    function Cargar_Monto_Aprobado() {
        let param = {
            FECHA_INI: FECHA_INI,
            FECHA_FIN: FECHA_FIN
        }
        AjaxSendReceiveData(url_Cargar_Monto_Aprobado, param, function(x) {

            if (x.success) {
                let datos = x.data;
                if (datos.length > 0) {
                    datos = datos[0]
                    $("#MONTO_APROBADO").text("$" + datos.MONTO_APROBADO);
                } else {

                }
            } else {

            }
        });
    }




    function Estado_formulario() {
        am4core.useTheme(am4themes_animated);

        let estadoFormularioChart = am4core.create("estadoFormularioChart", am4charts.XYChart);

        estadoFormularioChart.data = [{
                "estado": "Completadas",
                "total": 207
            },
            {
                "estado": "Iniciadas",
                "total": 155
            },
            {
                "estado": "Incompletas",
                "total": 26
            }
        ];

        let categoryAxisFormulario = estadoFormularioChart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxisFormulario.dataFields.category = "estado";
        categoryAxisFormulario.renderer.grid.template.location = 0;
        categoryAxisFormulario.renderer.minGridDistance = 30;

        let valueAxisFormulario = estadoFormularioChart.yAxes.push(new am4charts.ValueAxis());

        let seriesFormulario = estadoFormularioChart.series.push(new am4charts.ColumnSeries());
        seriesFormulario.dataFields.valueY = "total";
        seriesFormulario.dataFields.categoryX = "estado";
        seriesFormulario.name = "Total";
        seriesFormulario.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        seriesFormulario.columns.template.fillOpacity = 0.8;

        // Colores personalizados para cada columna
        seriesFormulario.columns.template.adapter.add("fill", function(fill, target) {
            if (target.dataItem && target.dataItem.categoryX === "Completadas") {
                return am4core.color("#28a745"); // Verde para Completadas
            } else if (target.dataItem && target.dataItem.categoryX === "Iniciadas") {
                return am4core.color("#ffc107"); // Naranja para Incompletas
            } else if (target.dataItem && target.dataItem.categoryX === "Incompletas") {
                return am4core.color("#007bff"); // Azul para Erroneas
            }
            return fill;
        });

        // Agregar etiquetas de datos encima de cada columna
        let labelBullet = seriesFormulario.bullets.push(new am4charts.LabelBullet());
        labelBullet.label.text = "{valueY}";
        labelBullet.label.dy = -10; // Posiciona la etiqueta encima de la columna
        labelBullet.label.fill = am4core.color("#000"); // Color de texto para la etiqueta
        labelBullet.label.fontSize = 14;

    }

    function Estado_de_credito() {
        let param = {
            FECHA_INI: FECHA_INI,
            FECHA_FIN: FECHA_FIN
        }

        AjaxSendReceiveData(url_Estado_de_credito, param, function(x) {
            console.log("🚀 ~ AjaxSendReceiveData ~ x:", x);
            
            if (x.success) {
                am4core.useTheme(am4themes_animated);

                let estadoFormularioChart = am4core.create("estadoCreditoChart", am4charts.XYChart);

                estadoFormularioChart.data = x.data;

                let categoryAxisFormulario = estadoFormularioChart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxisFormulario.dataFields.category = "estado";
                categoryAxisFormulario.renderer.grid.template.location = 0;
                categoryAxisFormulario.renderer.minGridDistance = 30;

                let valueAxisFormulario = estadoFormularioChart.yAxes.push(new am4charts.ValueAxis());

                let seriesFormulario = estadoFormularioChart.series.push(new am4charts.ColumnSeries());
                seriesFormulario.dataFields.valueY = "total";
                seriesFormulario.dataFields.categoryX = "estado";
                seriesFormulario.name = "Total";
                seriesFormulario.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
                seriesFormulario.columns.template.fillOpacity = 0.8;

                // Colores personalizados para cada columna
                seriesFormulario.columns.template.adapter.add("fill", function(fill, target) {
                    if (target.dataItem && target.dataItem.categoryX === "Aprobados") {
                        return am4core.color("#28a745"); // Verde para Completadas
                    } else if (target.dataItem && target.dataItem.categoryX === "Rechazados") {
                        return am4core.color("#007bff"); // Azul para Erroneas
                    }
                    return fill;
                });

                // Agregar etiquetas de datos encima de cada columna
                let labelBullet = seriesFormulario.bullets.push(new am4charts.LabelBullet());
                labelBullet.label.text = "{valueY}";
                labelBullet.label.dy = -10; // Posiciona la etiqueta encima de la columna
                labelBullet.label.fill = am4core.color("#000"); // Color de texto para la etiqueta
                labelBullet.label.fontSize = 14;
            }
        });


    }

    function Top5_ciudades() {
        // Crear gráfico de donut para "Top 5 Ciudades"
        let topCiudadesChart = am4core.create("topCiudadesChart", am4charts.PieChart);
        topCiudadesChart.innerRadius = am4core.percent(40); // Hacerlo un gráfico de donut

        topCiudadesChart.data = [{
                "ciudad": "Guayaquil",
                "usuarios": 120
            },
            {
                "ciudad": "Quito",
                "usuarios": 90
            },
            {
                "ciudad": "Cuenca",
                "usuarios": 45
            },
            {
                "ciudad": "Ambato",
                "usuarios": 25
            },
            {
                "ciudad": "Loja",
                "usuarios": 15
            }
        ];

        // Lista de colores personalizados
        let customColors = ["#4CAF50", "#FF5722", "#03A9F4", "#FFC107", "#9C27B0"];

        // Configurar la serie del gráfico de anillo
        let pieSeries = topCiudadesChart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "usuarios";
        pieSeries.dataFields.category = "ciudad";
        pieSeries.slices.template.tooltipText = "{category}: [bold]{value}[/]";

        // Asignar colores de la lista a cada segmento usando un adaptador
        pieSeries.slices.template.adapter.add("fill", function(fill, target) {
            let colorIndex = target.dataItem.index; // Obtener el índice del segmento
            return am4core.color(customColors[colorIndex % customColors.length]); // Asignar color en base al índice
        });

        // Deshabilitar las etiquetas y las líneas de conexión dentro del gráfico
        pieSeries.labels.template.disabled = true;
        pieSeries.ticks.template.disabled = true;

        // Agregar leyenda al lado del gráfico
        topCiudadesChart.legend = new am4charts.Legend();
        topCiudadesChart.legend.position = "right"; // Colocar la leyenda a la derecha
        topCiudadesChart.legend.valign = "middle"; // Centrar verticalmente la leyenda
        topCiudadesChart.legend.labels.template.text = "{name}"; // Mostrar el nombre de la ciudad
        topCiudadesChart.legend.valueLabels.template.text = "{value.percent.formatNumber('#.0')}%"; // Mostrar el porcentaje
        topCiudadesChart.legend.useDefaultMarker = true;

        // Personalizar el marcador de la leyenda para que coincida con los colores del gráfico
        let marker = topCiudadesChart.legend.markers.template.children.getIndex(0);
        marker.cornerRadius(12, 12, 12, 12); // Hacer los marcadores redondeados
        marker.width = 15;
        marker.height = 15;

    }

    function Estado_civil() {
        // Crear gráfico de donut para "Estado Civil"
        let estadoCivilChart = am4core.create("estadoCivilChart", am4charts.PieChart);
        estadoCivilChart.innerRadius = am4core.percent(40); // Hacerlo un gráfico de donut

        estadoCivilChart.data = [{
                "estadoCivil": "Soltero",
                "usuarios": 100
            },
            {
                "estadoCivil": "Casado",
                "usuarios": 80
            },
            {
                "estadoCivil": "Divorciado",
                "usuarios": 30
            },
            {
                "estadoCivil": "Viudo",
                "usuarios": 15
            }
        ];

        // Lista de colores personalizados para cada estado civil
        let estadoCivilColors = ["#4CAF50", "#FF5722", "#03A9F4", "#FFC107"];
        estadoCivilChart.colors.list = estadoCivilColors.map(function(color) {
            return am4core.color(color);
        });

        // Configurar la serie del gráfico de anillo
        let pieSeriesEstadoCivil = estadoCivilChart.series.push(new am4charts.PieSeries());
        pieSeriesEstadoCivil.dataFields.value = "usuarios";
        pieSeriesEstadoCivil.dataFields.category = "estadoCivil";
        pieSeriesEstadoCivil.slices.template.tooltipText = "{category}: [bold]{value}[/]";

        // Asignar colores de la lista a cada segmento usando un adaptador
        pieSeriesEstadoCivil.slices.template.adapter.add("fill", function(fill, target) {
            let colorIndex = target.dataItem.index; // Obtener el índice del segmento
            return am4core.color(estadoCivilColors[colorIndex % estadoCivilColors.length]); // Asignar color en base al índice
        });

        // Deshabilitar las etiquetas y las líneas de conexión dentro del gráfico
        pieSeriesEstadoCivil.labels.template.disabled = true;
        pieSeriesEstadoCivil.ticks.template.disabled = true;

        // Agregar leyenda al lado del gráfico
        estadoCivilChart.legend = new am4charts.Legend();
        estadoCivilChart.legend.position = "right"; // Colocar la leyenda a la derecha
        estadoCivilChart.legend.valign = "middle"; // Centrar verticalmente la leyenda
        estadoCivilChart.legend.labels.template.text = "{name}"; // Mostrar el nombre del estado civil
        estadoCivilChart.legend.valueLabels.template.text = "{value.percent.formatNumber('#.0')}%"; // Mostrar el porcentaje
        estadoCivilChart.legend.useDefaultMarker = true;

        // Personalizar el marcador de la leyenda para que coincida con los colores del gráfico
        let markerEstadoCivil = estadoCivilChart.legend.markers.template.children.getIndex(0);
        markerEstadoCivil.cornerRadius(12, 12, 12, 12); // Hacer los marcadores redondeados
        markerEstadoCivil.width = 15;
        markerEstadoCivil.height = 15;

    }

    function Rango_edades() {
        // Crear gráfico de columnas para "Rango de Edades" con todas las edades individuales
        let rangoEdadesChart = am4core.create("rangoEdadesChart", am4charts.XYChart);

        // Habilitar el zoom
        rangoEdadesChart.scrollbarX = new am4core.Scrollbar();
        rangoEdadesChart.scrollbarY = new am4core.Scrollbar();
        rangoEdadesChart.cursor = new am4charts.XYCursor();
        rangoEdadesChart.cursor.behavior = "zoomXY";

        // Datos de ejemplo

        rangoEdadesChart.data = [{
                "edad": "17",
                "usuarios": 15
            },
            {
                "edad": "18",
                "usuarios": 15
            },
            {
                "edad": "19",
                "usuarios": 20
            },
            {
                "edad": "20",
                "usuarios": 30
            },
            {
                "edad": "21",
                "usuarios": 25
            },
            {
                "edad": "22",
                "usuarios": 18
            },
            {
                "edad": "23",
                "usuarios": 22
            },
            {
                "edad": "24",
                "usuarios": 20
            },
            {
                "edad": "25",
                "usuarios": 25
            },
            {
                "edad": "26",
                "usuarios": 30
            },
            {
                "edad": "27",
                "usuarios": 28
            },
            {
                "edad": "28",
                "usuarios": 32
            },
            {
                "edad": "29",
                "usuarios": 27
            },
            {
                "edad": "30",
                "usuarios": 35
            },
            {
                "edad": "31",
                "usuarios": 30
            },
            {
                "edad": "32",
                "usuarios": 31
            },
            {
                "edad": "33",
                "usuarios": 26
            },
            {
                "edad": "34",
                "usuarios": 22
            },
            {
                "edad": "35",
                "usuarios": 19
            },
            {
                "edad": "36",
                "usuarios": 21
            },
            {
                "edad": "37",
                "usuarios": 25
            },
            {
                "edad": "38",
                "usuarios": 20
            },
            {
                "edad": "39",
                "usuarios": 22
            },
            {
                "edad": "40",
                "usuarios": 18
            },
            {
                "edad": "41",
                "usuarios": 17
            },
            {
                "edad": "42",
                "usuarios": 19
            },
            {
                "edad": "43",
                "usuarios": 22
            },
            {
                "edad": "44",
                "usuarios": 16
            },
            {
                "edad": "45",
                "usuarios": 15
            },
            {
                "edad": "46",
                "usuarios": 10
            },
            {
                "edad": "47",
                "usuarios": 12
            },
            {
                "edad": "48",
                "usuarios": 13
            },
            {
                "edad": "49",
                "usuarios": 14
            },
            {
                "edad": "50",
                "usuarios": 12
            },
            {
                "edad": "51",
                "usuarios": 11
            },
            {
                "edad": "52",
                "usuarios": 9
            },
            {
                "edad": "53",
                "usuarios": 8
            },
            {
                "edad": "54",
                "usuarios": 7
            },
            {
                "edad": "55",
                "usuarios": 6
            },
            {
                "edad": "56",
                "usuarios": 5
            },
            {
                "edad": "57",
                "usuarios": 4
            },
            {
                "edad": "58",
                "usuarios": 3
            },
            {
                "edad": "59",
                "usuarios": 2
            },
            {
                "edad": "60",
                "usuarios": 1
            }
        ];

        // Configuración de los ejes
        let categoryAxis = rangoEdadesChart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "edad";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 20;

        let valueAxis = rangoEdadesChart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.min = 0;

        // Crear la serie
        let series = rangoEdadesChart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "usuarios";
        series.dataFields.categoryX = "edad";
        series.columns.template.tooltipText = "Edad {categoryX}: [bold]{valueY} usuarios[/]";
        series.columns.template.width = am4core.percent(80); // Ancho de cada columna

        // Lista de colores para cada rango de edad
        let rangoEdadesColors = {
            "10-20": "#0000FF", // Azul
            "20-30": "#FF00FF", // Fucsia
            "30-40": "#FFA500", // Naranja
            "40-50": "#FF0000", // Rojo
            "50-60": "#00FFFF", // Celeste
            "60-70": "#008000", // Verde
            "70-80": "#FF8C00", // Naranja Oscuro
            "80-90": "#800080" // Morado
        };

        // Asignar colores a cada columna basado en el rango de edad
        series.columns.template.adapter.add("fill", function(fill, target) {
            let edad = parseInt(target.dataItem.categoryX); // Obtener la edad de cada columna
            if (edad >= 10 && edad < 20) return am4core.color(rangoEdadesColors["10-20"]);
            if (edad >= 20 && edad < 30) return am4core.color(rangoEdadesColors["20-30"]);
            if (edad >= 30 && edad < 40) return am4core.color(rangoEdadesColors["30-40"]);
            if (edad >= 40 && edad < 50) return am4core.color(rangoEdadesColors["40-50"]);
            if (edad >= 50 && edad < 60) return am4core.color(rangoEdadesColors["50-60"]);
            if (edad >= 60 && edad < 70) return am4core.color(rangoEdadesColors["60-70"]);
            if (edad >= 70 && edad < 80) return am4core.color(rangoEdadesColors["70-80"]);
            if (edad >= 80 && edad < 90) return am4core.color(rangoEdadesColors["80-90"]);
            return fill;
        });

        // Deshabilitar etiquetas de valores en la parte superior de cada columna
        series.bullets.clear(); // Remueve todas las etiquetas de valor

        // Agregar leyenda al lado del gráfico que muestra solo los rangos de edad
        rangoEdadesChart.legend = new am4charts.Legend();
        rangoEdadesChart.legend.position = "right"; // Colocar la leyenda a la derecha del gráfico
        rangoEdadesChart.legend.valign = "middle"; // Centrar la leyenda verticalmente
        rangoEdadesChart.legend.marginRight = 0; // Reducir margen a la derecha
        rangoEdadesChart.legend.itemContainers.template.padding(0, 0, 0, 0); // Quitar padding alrededor de cada elemento
        rangoEdadesChart.legend.itemContainers.template.margin(0, 0, 0, 0); // Quitar margen alrededor de cada elemento
        rangoEdadesChart.legend.useDefaultMarker = true;

        // Reducir tamaño de la leyenda y ajustar espaciado
        rangoEdadesChart.legend.labels.template.fontSize = 10; // Tamaño de fuente más pequeño
        rangoEdadesChart.legend.labels.template.maxWidth = 80; // Ajustar el ancho del texto
        rangoEdadesChart.legend.labels.template.truncate = false; // Permitir que el texto se muestre completo
        rangoEdadesChart.legend.itemContainers.template.paddingTop = 1;
        rangoEdadesChart.legend.itemContainers.template.paddingBottom = 1;
        rangoEdadesChart.legend.itemContainers.template.marginTop = 1;
        rangoEdadesChart.legend.itemContainers.template.marginBottom = 1;

        // Configurar leyenda manualmente para mostrar los rangos de edad y sus colores
        let legendData = [];
        for (let rango in rangoEdadesColors) {
            legendData.push({
                name: rango,
                fill: am4core.color(rangoEdadesColors[rango])
            });
        }
        rangoEdadesChart.legend.data = legendData;

        // Personalizar el marcador de la leyenda
        let marker = rangoEdadesChart.legend.markers.template.children.getIndex(0);
        marker.cornerRadius(5, 5, 5, 5); // Marcadores redondeados más pequeños
        marker.width = 8;
        marker.height = 8;

        // Hacer que los elementos de la leyenda controlen la visibilidad de los rangos
        rangoEdadesChart.legend.itemContainers.template.events.on("hit", function(ev) {
            let rangeName = ev.target.dataItem.dataContext.name;
            let isActive = ev.target.isActive;

            // Mostrar u ocultar las columnas según el rango de edad
            series.columns.each(function(column) {
                let edad = parseInt(column.dataItem.categoryX);
                if ((rangeName === "10-20" && edad >= 10 && edad < 20) ||
                    (rangeName === "20-30" && edad >= 20 && edad < 30) ||
                    (rangeName === "30-40" && edad >= 30 && edad < 40) ||
                    (rangeName === "40-50" && edad >= 40 && edad < 50) ||
                    (rangeName === "50-60" && edad >= 50 && edad < 60) ||
                    (rangeName === "60-70" && edad >= 60 && edad < 70) ||
                    (rangeName === "70-80" && edad >= 70 && edad < 80) ||
                    (rangeName === "80-90" && edad >= 80 && edad < 90)) {
                    column.visible = !isActive; // Cambiar visibilidad
                }
            });
            ev.target.isActive = !isActive; // Cambiar el estado de la leyenda
        });



    }

    function Top_salario() {
        // Crear gráfico de columnas para "Salario Top 5"
        let salarioTop5Chart = am4core.create("salarioTop5Chart", am4charts.XYChart);

        // Datos de ejemplo para los 5 salarios más altos por cantidad de personas
        salarioTop5Chart.data = [{
                "salario": "$500",
                "cantidad": 10
            },
            {
                "salario": "$600",
                "cantidad": 20
            },
            {
                "salario": "$700",
                "cantidad": 15
            },
            {
                "salario": "$800",
                "cantidad": 12
            },
            {
                "salario": "$900",
                "cantidad": 8
            }
        ];

        // Configuración de los ejes
        let categoryAxis = salarioTop5Chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "salario";
        categoryAxis.title.text = "Salario";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;

        let valueAxis = salarioTop5Chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "Cantidad";
        valueAxis.min = 0;

        // Crear la serie de columnas para la cantidad de personas en cada salario
        let series = salarioTop5Chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "cantidad";
        series.dataFields.categoryX = "salario";
        series.columns.template.tooltipText = "Salario {categoryX}: [bold]{valueY} personas[/]";
        series.columns.template.width = am4core.percent(60); // Ancho de cada columna

        // Colores personalizados para cada columna
        let colors = ["#FF5733", "#33FF57", "#3357FF", "#FF33A1", "#FFA533"];
        series.columns.template.adapter.add("fill", function(fill, target) {
            return am4core.color(colors[target.dataItem.index % colors.length]);
        });

        // Etiquetas de valores en la parte superior de cada columna
        let labelBullet = series.bullets.push(new am4charts.LabelBullet());
        labelBullet.label.text = "{valueY}";
        labelBullet.label.dy = -10; // Posiciona la etiqueta encima de la columna
        labelBullet.label.hideOversized = false;
        labelBullet.label.truncate = false;

        // Deshabilitar el borde de las columnas
        series.columns.template.strokeWidth = 0;

        // Agregar leyenda al gráfico
        salarioTop5Chart.legend = new am4charts.Legend();
        salarioTop5Chart.legend.position = "right"; // Colocar la leyenda a la derecha del gráfico
        salarioTop5Chart.legend.valign = "middle"; // Centrar la leyenda verticalmente
        salarioTop5Chart.legend.useDefaultMarker = true;

        // Configurar leyenda manualmente para mostrar los niveles de salario
        let legendData = salarioTop5Chart.data.map((data, index) => {
            return {
                name: `${data.salario}`,
                fill: am4core.color(colors[index % colors.length])
            };
        });
        salarioTop5Chart.legend.data = legendData;

        // Personalizar el marcador de la leyenda
        let marker = salarioTop5Chart.legend.markers.template.children.getIndex(0);
        marker.cornerRadius(5, 5, 5, 5); // Marcadores redondeados
        marker.width = 12;
        marker.height = 12;


    }

    function Trafico() {
        // Crear gráfico de líneas para "Tráfico de Conversaciones"
        let traficoConversacionesChart = am4core.create("traficoConversacionesChart", am4charts.XYChart);

        // Datos de ejemplo para el tráfico de conversaciones a lo largo de un día, desde las 00:00 hasta las 23:00
        traficoConversacionesChart.data = [{
                "hora": "00:00",
                "conversaciones": 3
            },
            {
                "hora": "01:00",
                "conversaciones": 2
            },
            {
                "hora": "02:00",
                "conversaciones": 1
            },
            {
                "hora": "03:00",
                "conversaciones": 0
            },
            {
                "hora": "04:00",
                "conversaciones": 1
            },
            {
                "hora": "05:00",
                "conversaciones": 2
            },
            {
                "hora": "06:00",
                "conversaciones": 3
            },
            {
                "hora": "07:00",
                "conversaciones": 5
            },
            {
                "hora": "08:00",
                "conversaciones": 8
            },
            {
                "hora": "09:00",
                "conversaciones": 12
            },
            {
                "hora": "10:00",
                "conversaciones": 15
            },
            {
                "hora": "11:00",
                "conversaciones": 20
            },
            {
                "hora": "12:00",
                "conversaciones": 18
            },
            {
                "hora": "13:00",
                "conversaciones": 16
            },
            {
                "hora": "14:00",
                "conversaciones": 14
            },
            {
                "hora": "15:00",
                "conversaciones": 22
            },
            {
                "hora": "16:00",
                "conversaciones": 25
            },
            {
                "hora": "17:00",
                "conversaciones": 20
            },
            {
                "hora": "18:00",
                "conversaciones": 18
            },
            {
                "hora": "19:00",
                "conversaciones": 15
            },
            {
                "hora": "20:00",
                "conversaciones": 12
            },
            {
                "hora": "21:00",
                "conversaciones": 10
            },
            {
                "hora": "22:00",
                "conversaciones": 7
            },
            {
                "hora": "23:00",
                "conversaciones": 5
            }
        ];

        // Configuración de los ejes
        let categoryAxis = traficoConversacionesChart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "hora";
        categoryAxis.title.text = "Hora del Día";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 20;

        // Mostrar las horas en formato vertical
        categoryAxis.renderer.labels.template.rotation = 270;
        categoryAxis.renderer.labels.template.horizontalCenter = "right";
        categoryAxis.renderer.labels.template.verticalCenter = "middle";

        let valueAxis = traficoConversacionesChart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "Cantidad de Conversaciones";
        valueAxis.min = 0;

        // Crear la serie de líneas para el tráfico de conversaciones
        let series = traficoConversacionesChart.series.push(new am4charts.LineSeries());
        series.dataFields.valueY = "conversaciones";
        series.dataFields.categoryX = "hora";
        series.name = "Conversaciones";
        series.strokeWidth = 2;
        series.tooltipText = "{name} a las {categoryX}: [bold]{valueY}[/]";

        // Personalizar el círculo de cada punto de datos (bullet)
        let bullet = series.bullets.push(new am4charts.CircleBullet());
        bullet.circle.radius = 3;
        bullet.circle.strokeWidth = 2;
        bullet.circle.fill = am4core.color("#fff");

        // Habilitar el cursor para interacción
        traficoConversacionesChart.cursor = new am4charts.XYCursor();
        traficoConversacionesChart.cursor.behavior = "zoomXY";

        // Agregar leyenda al gráfico
        traficoConversacionesChart.legend = new am4charts.Legend();
        traficoConversacionesChart.legend.position = "top";
        traficoConversacionesChart.legend.valign = "middle";
        traficoConversacionesChart.legend.labels.template.fontSize = 12;
        traficoConversacionesChart.legend.useDefaultMarker = true;

        // Configuración del tooltip para mostrar los datos de cada punto al pasar el ratón
        series.tooltip.getFillFromObject = false;
        series.tooltip.background.fill = am4core.color("#3b3b3b");
        series.tooltip.background.strokeWidth = 0;
        series.tooltip.background.cornerRadius = 5;
        series.tooltip.label.fill = am4core.color("#ffffff");


    }
</script>