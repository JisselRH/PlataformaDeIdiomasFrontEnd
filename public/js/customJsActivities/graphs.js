var initMixedWidget10b = function (data) {

    var graphWindow = document.querySelector(".graph-container");
    console.log(graphWindow);

    //var graphWindow = graphContainer[0];
    const insideChart = jQuery('<div>');
    $(graphWindow).html(insideChart);
    // return;

    var charts = graphWindow.querySelector('div');

    var color;
    var height;
    var labelColor = '#A1A5B7';
    var borderColor = '#E4E6EF';
    var baseLightColor;
    var secondaryColor = '#E4E6EF';
    var baseColor;
    var options;
    var chart;

    color = "#000000";
    // height = 500;
    // baseColor = KTUtil.getCssVariableValue('--bs-' + color);
    baseColor = "#8557a7";

    const description = {
        0: "Evaluación general de como se dijo la frases, es una mezcla de todos los criterios",
        1: "Fluidez de la frase, es continuidad con la que se dicen la frase",
        2: "Que tan precisa fue la pronunciación de la frase",
        3: "Completitud de la frase, es la cantidad de palabras que efectivamente se dijeron"
    }


    options = {
        series: [{
            name: 'Descripción',
            data: data['score']
        }],
        chart: {
            fontFamily: 'inherit',
            type: 'bar',
            size: 'auto',
            height: "100%",
            width: "100%",
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: ['25%'],
                columnHeight: ['90%'],
                borderRadius: 4
            },
        },
        legend: {
            show: false
        },
        dataLabels: {
            enabled: true,
            position: "top",
            style: {
                colors: ['#000000'],
                fontSize: '2vw'
            },
            offsetY: '5%',
            formatter: function (val) {
                return val.toFixed(0)
            }


        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: data['categories'],
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: labelColor,
                    fontSize: '2vw'
                }
            }
        },
        yaxis: {
            y: 0,
            offsetX: 0,
            offsetY: 0,
            max: 100,
            tickAmount: 4,
            labels: {
                style: {
                    colors: labelColor,
                    fontSize: 'fontSize: 2vw'
                },
                formatter: function (val) {
                    return val.toFixed(0)
                }
            }
        },
        fill: {
            type: 'solid'
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
            custom: function({series, seriesIndex, dataPointIndex, w}) {
                const index = dataPointIndex;
                return custom(description[index], data['categories'][index])
              },
            // style: {
            //     fontSize: '12px'
            // },
            // y: {
            //     formatter: function (val, { series, seriesIndex, dataPointIndex, w }) {
            //         return description[dataPointIndex];
            //     },

            // }
        },
        colors: [baseColor],
        grid: {
            padding: {
                top: 10
            },
            borderColor: borderColor,
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: true
                }
            }
        }
    };

    chart = new ApexCharts(charts, options);
    chart.render();
}

export {
    initMixedWidget10b
}

function custom(description, category) {
    return `
    <div class="card " style="">
        <div class="gray-back card-header fz-12 py-2 lh-100 " style="background-color: #EEE;">
            ${category}
        </div>
        <div class="card-body fz-10 p-2 w-100" style="">
            ${description}
        </div>
    </div>
    `
}