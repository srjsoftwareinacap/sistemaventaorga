 <div class="wrapper">

      <header id="modificar" class="main-header">
       
        <a href="#" class="logo">
        
          <span class="logo-mini"><b>A</b>LT</span>
          
          <span class="logo-lg" id="titulo"><b>Sistema de </b>Ventas</span>
        </a>
        
        <nav class="navbar navbar-static-top" role="navigation">
       
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
            
                  
                 
            <li   id="sessiones" >
                <a style="color: white" class="btn btn-info  " href="<?php echo base_url().'Pagina/cerrar';?>">
  <i class="fa fa-sign-out  btn-info pull-left"></i> Cerrar session</a>
             
              </li>
        </nav>
         
      </header>
      
      <aside id ="menu" class="main-sidebar">
        
        <section class="sidebar">
         
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
              <li style="color: white" class="header">Panel de Navegación</li>
            <li class="active treeview">
              <a href="<?php echo base_url().'Pagina/gventas';?>">
                <i class="fa fa-shopping-cart"></i> <span>Realizar ventas</span> 
              </a>
             
            </li>
        <li class="treeview">
            <a style="color: red" href="#">
                <i  class="fa fa-bar-chart "></i>
                <span>Reporte de ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            
            </li>
          </ul>
        </section>
       
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            
            <small>Reporte de ventas</small>
          </h1>
          
        </section>

        <!-- Main content -->
        <section id="contentparagrafico" class="content">
            <div id="mensajeparagrafico"></div>
            <div id="tabs">
	<ul>
		<li><a href="#tabs-1">Reporte por venta por vendedor</a></li>
		<li><a href="#tabs-2">Reporte mensual </a></li>
		<li><a href="#tabs-3">Reporte de servicio tecnico</a></li>
	</ul>
                <div id="tabs-1">
                    <div id="primergrafico" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                </div>
                <div id="tabs-2">
                    <div id="segundografico" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                </div>
                <div id="tabs-3">
                    
                </div>
</div>
               
            
    
<script type="text/javascript">
Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
    return {
        radialGradient: {
            cx: 0.5,
            cy: 0.3,
            r: 0.7
        },
        stops: [
            [0, color],
            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
        ]
    };
});
Highcharts.chart('primergrafico', {
    
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Ventas mensuales por vendedor'
    },
    subtitle: {
        text: 'Sistema delta motosierra'
    },
    xAxis: {
        categories: [
            <?php
            $sql2 =mysql_query("SET lc_time_names = 'es_cl';
");
            $sql = mysql_query("SELECT SUM(venta.total) as total ,MONTHNAME(venta.fecha) as mes, usuario_empresa.nombre_usuario  from venta INNER JOIN usuario_empresa on venta.rut_vendedor= usuario_empresa.rut_usuario where venta.fecha like '2017-%-%' GROUP by usuario_empresa.nombre_usuario, mes ORDER by mes");
            while ($row = mysql_fetch_array($sql)) {
                ?>
                ['<?php echo $row['nombre_usuario'].' '.$row['mes'] ?>'],
                    
<?php
            }
            
            ?>
    
           
            
        ],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Miles de (pesos)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' PESOS'
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
    {
        name: 'Pesos',
        data: [
     <?php
            $sql2 =mysql_query("SET lc_time_names = 'es_cl';
");
            $sql = mysql_query("SELECT SUM(venta.total) as total ,MONTHNAME(venta.fecha) as mes, usuario_empresa.nombre_usuario  from venta INNER JOIN usuario_empresa on venta.rut_vendedor= usuario_empresa.rut_usuario where venta.fecha like '2017-%-%' GROUP by usuario_empresa.nombre_usuario, mes ORDER by mes");
            
            while ($row = mysql_fetch_array($sql)) {
                ?>
                            
                <?php echo $row['total']?>,
                    
<?php
            }
            
            ?>
                            ]
    }]
});
Highcharts.chart('segundografico', {

    chart: {
        type: 'variwide'
    },

    title: {
        text: 'Reporte de venta mensuales'
    },
 yAxis: {
        min: 0,
        title: {
            text: 'Miles de (pesos)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    subtitle: {
        text: 'Sistema Delta Motosierra'
    },

    xAxis: {
        type: 'category',
        title: {
            text: 'Meses del año'
        }
    },

    legend: {
        enabled: false
    },

    series: [{
        name: 'Labor Costs',
        data: [
            <?php
            $sql3 =mysql_query("SET lc_time_names = 'es_cl';
");
            $sql5 = mysql_query("SELECT SUM(venta.total) as venta,MONTHNAME(venta.fecha) as mes from venta where venta.fecha like '2017-%-%' GROUP by mes");
            
            while ($row = mysql_fetch_array($sql5)) {
                ?>
                            ['<?php echo $row['mes']?>',<?php echo $row['venta']?>,4],
               
                    
<?php
            }
            
            ?>
        ],
        dataLabels: {
            enabled: true,
            format: '${point.y:.0f}'
        },
        tooltip: {
            pointFormat: 'Ventas: <b>€ {point.y}</b><br>'
        },
        colorByPoint: true
    }]

});


		</script>
                
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Sistema Delta motosierras </strong> .
      </footer>

     
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->