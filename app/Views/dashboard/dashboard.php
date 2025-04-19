<?= $this->extend('Template/base') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

<link href="plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css">
<link href="css/style.bundle.css" rel="stylesheet" type="text/css">
<link href="css/style.fonts.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/dinamic-font.css">

<div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-400px px-1 overflow-scroll" style="height: content-fit; padding-top: 3%; margin-left:10%; margin-right:10%; margin-top:2%; justify-content: normal; overflow-x: hidden; ">
    <div class="card px-3 my-3 border rounded shadow-sm" style="width: 100%; padding-top: 0;">
        <div class="row bahnschriftRegular" style="width: 100%;">

            <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-left:2%;">
                <li class="nav-item mt-2">
                    <a class="nav-link text-black ms-0 me-10 py-5 active" id="estadisticas-tab" data-toggle="tab" href="#estadisticas" role="tab" aria-controls="estadisticas" aria-selected="true" style="font-size: 1.2rem;">Estadísticas</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-black ms-0 me-10 py-5" id="logros-tab" data-toggle="tab" href="#logros" role="tab" aria-controls="logros" aria-selected="false" style="font-size: 1.2rem;">Logros</a>
                </li>

                <select onchange="actualizar(this)" class="form-select form-select-lg mb-3 border border-warning border-3 rounded-3 bahnschrifBold fw-bolder" style="width: 20%; margin-left:2%; margin-top:1%">
                    <option value="p">Pronunciación</option>
                    <option value="d">Diálogo</option>
                </select>

            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane show active" id="estadisticas" role="tabpanel" aria-labelledby="estadisticas-tab">
                    <?= $this->include('dashboard/estadisticas') ?>
                </div>

                <div class="tab-pane fade" id="logros" role="tabpanel" aria-labelledby="logros-tab">
                    <?= $this->include('dashboard/logros') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery/jquery-3.3.1.min.js"></script>
<script src="plugins/global/plugins.bundle.js"></script>
<script src="js/scripts.bundle.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.3.js" crossorigin="anonymous"></script>



<script>
    "use strict";

    var myChart, chartMes, chartSemana, actual = "p";

    $('#myTab a').on('click', function(e) {
        e.preventDefault()
        $(this).tab('show')
    })

    // Class definition
    var KTWidgetsDashboard = function() {

        //alert(" KTWidgetsDashboard "+actual);

        var initMixedWidgetWeek = function($dataPHP) {

            var charts = document.querySelectorAll('.mixed-widget-dashboard-chart');

            [].slice.call(charts).map(function(element) {
                var height = parseInt(KTUtil.css(element, 'height'));

                if (!element) {
                    return;
                }

                var color = element.getAttribute('data-kt-chart-color');

                var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-800');
                var strokeColor = KTUtil.getCssVariableValue('--bs-' + 'gray-300');
                var baseColor = KTUtil.getCssVariableValue('--bs-' + color);
                var lightColor = KTUtil.getCssVariableValue('--bs-light-' + color);

                var options = {
                    series: [{
                        name: 'Experiencia',
                        data: $dataPHP
                    }],
                    chart: {
                        fontFamily: 'inherit',
                        type: 'area',
                        height: height,
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                        sparkline: {
                            enabled: false
                        }
                    },
                    plotOptions: {},
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    fill: {
                        type: 'solid',
                        opacity: 1
                    },
                    fill1: {
                        type: 'gradient',
                        opacity: 1,
                        gradient: {
                            type: "vertical",
                            shadeIntensity: 0.5,
                            gradientToColors: undefined,
                            inverseColors: true,
                            opacityFrom: 1,
                            opacityTo: 0.375,
                            stops: [25, 50, 100],
                            colorStops: []
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        show: true,
                        width: 3,
                        colors: [baseColor]
                    },
                    xaxis: {
                        categories: ['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do'],
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            show: true,
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        },
                        crosshairs: {
                            show: false,
                            position: 'front',
                            stroke: {
                                color: strokeColor,
                                width: 1,
                                dashArray: 3
                            }
                        },
                        tooltip: {
                            enabled: true,
                            formatter: undefined,
                            offsetY: 0,
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        min: 0,
                        max: 80,
                        labels: {
                            show: true,
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        }
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px'
                        },
                        y: {
                            formatter: function(val) {
                                return val //" thousands"
                            }
                        }
                    },
                    colors: [lightColor],
                    markers: {
                        colors: [lightColor],
                        strokeColor: [baseColor],
                        strokeWidth: 3
                    }
                };

                if (chartSemana)
                    chartSemana.destroy();

                chartSemana = new ApexCharts(element, options);
                chartSemana.render();
            });
        }

        var initMixedWidgetMonth = function($dataPHP, $semanasMes) {
            var charts = document.querySelectorAll('.mixed-widget-dashboard-chart-2');

            [].slice.call(charts).map(function(element) {
                var height = parseInt(KTUtil.css(element, 'height'));

                if (!element) {
                    return;
                }

                var color = element.getAttribute('data-kt-chart-color');

                var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-800');
                var strokeColor = KTUtil.getCssVariableValue('--bs-' + 'gray-300');
                var baseColor = KTUtil.getCssVariableValue('--bs-' + color);
                var lightColor = KTUtil.getCssVariableValue('--bs-light-' + color);

                var options = {
                    series: [{
                        name: 'Experiencia',
                        //data: [50, 0, 80, 150]
                        data: $dataPHP
                    }],
                    chart: {
                        fontFamily: 'inherit',
                        type: 'area',
                        height: height,
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                        sparkline: {
                            enabled: false
                        }
                    },
                    plotOptions: {},
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    fill: {
                        type: 'solid',
                        opacity: 1
                    },
                    fill1: {
                        type: 'gradient',
                        opacity: 1,
                        gradient: {
                            type: "vertical",
                            shadeIntensity: 0.5,
                            gradientToColors: undefined,
                            inverseColors: true,
                            opacityFrom: 1,
                            opacityTo: 0.375,
                            stops: [50, 100, 150],
                            colorStops: []
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        show: true,
                        width: 3,
                        colors: [baseColor]
                    },
                    xaxis: {
                        //categories: ['1 era', '2da', '3era', '4ta'],
                        categories: $semanasMes,
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            show: true,
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        },
                        crosshairs: {
                            show: false,
                            position: 'front',
                            stroke: {
                                color: strokeColor,
                                width: 1,
                                dashArray: 3
                            }
                        },
                        tooltip: {
                            enabled: true,
                            formatter: undefined,
                            offsetY: 0,
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        min: 0,
                        max: 150,
                        labels: {
                            show: true,
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        }
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px'
                        },
                        y: {
                            formatter: function(val) {
                                return val //+ " thousands"
                            }
                        }
                    },
                    colors: [lightColor],
                    markers: {
                        colors: [lightColor],
                        strokeColor: [baseColor],
                        strokeWidth: 3
                    }
                };

                if (chartMes)
                    chartMes.destroy();

                chartMes = new ApexCharts(element, options);
                chartMes.render();
            });
        }

        var initChartFinalPercentage = function($avance) {
            // Define chart element
            var ctx = document.getElementById('kt_pie_chart');

            // Define colors
            var primaryColor = KTUtil.getCssVariableValue('--bs-primary');
            var dangerColor = KTUtil.getCssVariableValue('--bs-danger');
            var successColor = KTUtil.getCssVariableValue('--bs-success');
            var warningColor = KTUtil.getCssVariableValue('--bs-warning');
            var infoColor = KTUtil.getCssVariableValue('--bs-info');

            //var height = parseInt(KTUtil.css(element, 'height'));

            // Chart labels
            const labels = ['Bien', 'Mal'];

            // Chart data
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Porcentaje total',
                    data: [$avance, 100 - $avance],
                    backgroundColor: ['#FFC300', '#000000']
                }, ]
            };

            // Chart config
            const config = {
                type: 'pie',
                data: data,
                //height: 20,
                options: {
                    plugins: {
                        title: {
                            display: false,
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                color: 'rgb(0, 0, 0)'
                            }
                        }
                    },
                    responsive: true,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },

                    /*tooltips: {
                        enabled: false,
                        intersect: false,
                        mode: 'nearest',
                        bodySpacing: 5,
                        yPadding: 10,
                        xPadding: 10,
                        caretPadding: 0,
                        displayColors: true,
                        backgroundColor: '#20D489',
                        titleFontColor: '#ffffff',
                        cornerRadius: 4,
                        footerSpacing: 0,
                        titleSpacing: 0
                    },
                    tooltip: {
                        show: true,
                        style: {
                            fontSize: '12px'
                        },
                        formatter: function(val) {
                            return val + "%";
                        }
                    },
                    labels: {
                        show: true,
                        formatter: function(val) {
                            return val + "%";
                        }
                    } ,
                    dataLabels: {
                        enabled: false,
                        formatter: function(val) {
                            return val + "%";
                        },
                        offsetY: -20,
                        style: {
                            fontSize: '12px',
                            colors: ["#304758"]
                        }
                    },*/
                }
            };

            // Init ChartJS -- for more info, please visit: https://www.chartjs.org/docs/latest/
            //var myChart = new Chart(ctx, config);

            if (myChart)
                myChart.destroy();

            myChart = new Chart(ctx, config);
            myChart.render();
        }

        return {
            init: function() {

                // Charts widgets
                const semanaPronunciacion = [];
                <?php foreach ($estadisticas['semanaPronunciacion'] as &$valor) { ?>
                    semanaPronunciacion.push(<?php echo $valor ?>);
                <?php } ?>

                const mesPronunciacion = [];
                <?php foreach ($estadisticas['mesPronunciacion'] as &$valor) { ?>
                    mesPronunciacion.push(<?php echo $valor ?>);
                <?php } ?>

                const semanasMes = ["1era", "2da", "3era", "4ta", "5ta"];

                const semanaDialogo = [];
                <?php foreach ($estadisticas['semanaDialogo'] as &$valor) { ?>
                    semanaDialogo.push(<?php echo $valor ?>);
                <?php } ?>

                const mesDialogo = [];
                <?php foreach ($estadisticas['mesDialogo'] as &$valor) { ?>
                    mesDialogo.push(<?php echo $valor ?>);
                <?php } ?>

                const avanceDialogo = <?php echo $estadisticas['avanceDialogo'][0] ?>;
                const avancePronunciacion = <?php echo $estadisticas['avancePronunciacion'] ?>;

                const logroDiarioPronunciacion = <?php echo $estadisticas['logroDiarioPronunciacion'] ?>;
                const logroDiarioDialogo = <?php echo $estadisticas['logroDiarioDialogo'] ?>;

                var progressbar1 = document.getElementById("progress1");
                var progressbar2 = document.getElementById("progress2");
                var progressbar3 = document.getElementById("progress3");

                var span1 = document.getElementById("span1");
                var span2 = document.getElementById("span2");
                var span3 = document.getElementById("span3");

                const avatars = document.querySelectorAll(".col-1-logros svg");
                const avatars1 = document.querySelectorAll('.col-2-logros svg');

                avatars.forEach(element => {
                    element.style.color = "#b8aaaa"
                    element.style.filter = "brightness(100%)";
                });

                avatars1.forEach(element => {
                    element.style.color = "#b8aaaa"
                    element.style.filter = "brightness(100%)";
                });

                if (actual == "d") {
                    initMixedWidgetWeek(semanaDialogo);
                    initMixedWidgetMonth(mesDialogo, semanasMes);
                    initChartFinalPercentage(avanceDialogo);

                    //actualizar width del progress1 y eso y valor de span1
                    progressbar1.style.width = avanceDialogo + "%";
                    progressbar2.style.width = avanceDialogo + "%";
                    progressbar3.style.width = avanceDialogo + "%";

                    span1.textContent = avanceDialogo + "%";
                    span2.textContent = avanceDialogo + "%";
                    span3.textContent = avanceDialogo + "%";

                    // logros
                    if (logroDiarioDialogo >= 10)
                    {
                        avatars[0].style.color = "#000000"
                        avatars[0].style.filter = "brightness(0%)";
                    }

                    if (logroDiarioDialogo >= 20) {
                        avatars[1].style.color = "#000000"
                        avatars[1].style.filter = "brightness(0%)";
                    }

                    if (logroDiarioDialogo >= 30) {
                        avatars[2].style.color = "#000000"
                        avatars[2].style.filter = "brightness(0%)";
                    }

                    if (logroDiarioDialogo >= 40) {
                        avatars[3].style.color = "#000000"
                        avatars[3].style.filter = "brightness(0%)";
                    }

                    if (logroDiarioDialogo >= 50) {
                        avatars1[0].style.color = "#000000"
                        avatars1[0].style.filter = "brightness(0%)";
                    }

                    if (logroDiarioDialogo >= 60) {
                        avatars1[1].style.color = "#000000"
                        avatars1[1].style.filter = "brightness(0%)";
                    }

                    if (logroDiarioDialogo >= 70) {
                        avatars1[2].style.color = "#000000"
                        avatars1[2].style.filter = "brightness(0%)";
                    }

                    if (logroDiarioDialogo >= 80) {
                        avatars1[3].style.color = "#000000"
                        avatars1[3].style.filter = "brightness(0%)";
                    }
                } else {

                    progressbar1.style.width = avancePronunciacion + "%";
                    progressbar2.style.width = avancePronunciacion + "%";
                    progressbar3.style.width = avancePronunciacion + "%";

                    span1.textContent = avancePronunciacion + "%";
                    span2.textContent = avancePronunciacion + "%";
                    span3.textContent = avancePronunciacion + "%";

                    initMixedWidgetWeek(semanaPronunciacion);
                    initMixedWidgetMonth(mesPronunciacion, semanasMes);
                    initChartFinalPercentage(avancePronunciacion);

                    if (logroDiarioPronunciacion >= 10) {
                        //avatars[0].color = "#000000";
                        avatars[0].style.color = "#000000"
                        avatars[0].style.filter = "brightness(0%)";
                    }


                    if (logroDiarioPronunciacion >= 20){
                        avatars[1].style.color = "#000000"
                        avatars[1].style.filter = "brightness(0%)";
                    }

                    if (logroDiarioPronunciacion >= 30){
                        avatars[2].style.color = "#000000"
                        avatars[2].style.filter = "brightness(0%)";
                    }

                    if (logroDiarioPronunciacion >= 40){
                        avatars[3].style.color = "#000000"
                        avatars[3].style.filter = "brightness(0%)";
                    }

                    if (logroDiarioPronunciacion >= 50){
                        avatars1[0].style.color = "#000000"
                        avatars1[0].style.filter = "brightness(0%)";
                    }

                    if (logroDiarioPronunciacion >= 60){
                        avatars1[1].style.color = "#000000"
                        avatars1[1].style.filter = "brightness(0%)";
                    }

                    if (logroDiarioPronunciacion >= 70){
                        avatars1[2].style.color = "#000000"
                        avatars1[2].style.filter = "brightness(0%)";
                    }

                    if (logroDiarioPronunciacion >= 80){
                        avatars1[3].style.color = "#000000"
                        avatars1[3].style.filter = "brightness(0%)";
                    }
                }

            }
        }
    }();

    // al cambiar el select recargar funciones

    var actualizar = function(opcion) {

        if (opcion.value == "d")
            actual = "d";
        else
            actual = "p";

        KTWidgetsDashboard.init();
    }

    // On document ready
    KTUtil.onDOMContentLoaded(function() {
        KTWidgetsDashboard.init();
    });

</script>

<?= $this->endSection() ?>