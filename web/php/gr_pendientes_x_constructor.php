<?php
	require_once("conexion.php");
	$id_constr=$_GET['constructor'];
	$i=0;
	echo "<script> var construct='';var pendientes= new Array();var abiertos= new Array();var cerrados= new Array();var promedios= new Array(); </script>";
	$query_sql = "SELECT c.nombre,t.descripcion_pend pendientes, SUM(CASE WHEN p.estado LIKE 'ABIERTO' THEN 1 ELSE 0 END) abiertos, 
SUM(CASE WHEN p.estado LIKE 'CERRADO' THEN 1 ELSE 0 END) cerrados, count(*)/2::numeric promedio
FROM control_de_pendientes p, constructores c,tipo_pendientes t
WHERE c.id=p.constructor and p.tipo_pendiente=t.id
and c.id=$id_constr
GROUP BY c.nombre,t.descripcion_pend;"; 	
//echo	$query_sql;
	$resultado = pg_query($cx,$query_sql) or die(pg_last_error());
	$total_filas = pg_num_rows($resultado);	 
	while ($fila = pg_fetch_assoc($resultado)) {
	echo "<script> </script>";
	if ($i==0) {echo "<script> construct='".$fila['nombre']."'; </script>";}
				
			echo "<script>pendientes[".$i."]='".$fila['pendientes']."'; </script>";
			echo "<script>abiertos[".$i."]=".$fila['abiertos']."; </script>";
			echo "<script>cerrados[".$i."]=".$fila['cerrados']."; </script>";
			echo "<script>promedios[".$i."]=".$fila['promedio']."; </script>";
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
 text: 'Pendientes '+construct
 },
 xAxis: {
 categories: pendientes
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
  name: 'Abiertos',
  color: '#FF8C00',
 data: abiertos
 }, {
 type: 'column',
 name: 'Cerrados',
 color: '#7CFC00',
 data: cerrados
 }, {
 type: 'spline',
 name: 'Promedio',
 data: promedios,
 marker: {
 lineWidth: 3,
 lineColor: Highcharts.getOptions().colors[3],
 fillColor: 'white'
 }
 }
 ]
 });
 });
});</script>"; ?>