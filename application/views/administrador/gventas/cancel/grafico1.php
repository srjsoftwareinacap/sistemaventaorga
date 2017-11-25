<script type="text/javascript">
    Highcharts.chart('primergrafico', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Reporte venta por vendedor mensual'
    },
    subtitle: {
        text: 'Informacion de sistema delta'
    },
    xAxis: {
        
        
        categories: [
            
            
            
            <?php foreach($listaarrecorrer as $valor):?>
            ['<?php echo $valor->nombre_usuario;?>'],
           <?php endforeach;?>
        ],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Population (millions)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' millions'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [
        series: [
    
        <?php foreach($listaarrecorrer as $valor):?>
            {
                name: <?php echo $valor->nombre_usuario;?>,
            [<?php echo $valor->total;?>],
        }
           <?php endforeach;?>
       
    
    
]
});
    </script>