<?php
	require_once("conexion.php");

	$i=0;
	echo "<script> var constructores= new Array();var promedios= new Array(); </script>";
	$query_sql = "SELECT c.nombre,avg(fecha_cierre-fecha_registro) promedio
FROM constructores c left join control_de_pendientes p on (c.id=p.constructor) left join tipo_pendientes t
on (p.tipo_pendiente=t.id)
--and estado LIKE 'CERRADO'
GROUP BY c.nombre;"; 	
//echo	$query_sql;
	$resultado = pg_query($cx,$query_sql) or die(pg_last_error());
	$total_filas = pg_num_rows($resultado);	 
	while ($fila = pg_fetch_assoc($resultado)) {
				
			echo "<script>constructores[".$i."]='".$fila['nombre']."'; </script>";
			if ($fila['promedio']>0) echo "<script>promedios[".$i."]=".$fila['promedio']."; </script>";
			else echo "<script>promedios[".$i."]=0; </script>";
			$i++;
		} 
		
		//echo "<script> alert (constructores);alert (abiertos);alert (cerrados);alert (promedios);</script>";
		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "xhtml11.dtd">

<html debug="true">
<head>
<title>Reportes Gr&aacute;ficos GRODCO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--  meta http-equiv="X-UA-Compatible" content="chrome=1" -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
	<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="style='min-width: 90%; height: 300px; "></div>

</body>

</html>
<?php
echo "<script> $(function () {
 var chart;
 $(document).ready(function() {
 chart = new Highcharts.Chart({
 chart: {
 renderTo: 'container'
 },
 title: {
 text: 'Tiempo Promedio de Solucion de Pendientes'
 },
 xAxis: {
 categories: constructores
 },
 tooltip: {
 formatter: function() {
 var s;
 if (this.point.name) { // the pie chart
 s = ''+
 this.point.name +': '+ this.y +' avance';
 } else {
 s = ''+
 this.x +': '+ this.y;
 }
 return s;
 }
 },
 labels: {
 items: [{
 html: 'SUPERVISION RED NACIONAL DE FIBRA OPTICA',
 style: {
 left: '40px',
 top: '8px',
 color: 'black'
 }
 }]
 },
 series: [{
  type: 'column',
  name: 'Dias',
 data: promedios
}, {
 type: 'spline',
 name: 'Promedio',
 data: promedios,
 marker: {
 lineWidth: 3,
 lineColor: Highcharts.getOptions().colors[1],
 fillColor: 'white'
 }
 }
 ]
 });
 });
});</script>"; ?>