<?php
if (!isset($_SESSION)) { session_start();}
require_once("conexion.php"); ?>
<?php
	$depto = $_GET['depto'];
	$tramo = $_GET['tramo'];
	$filtro = "";
	if($depto !=0 and $depto !=999999) $filtro = " and d.gid='$depto'";
	if($tramo !=0 and $tramo !=999999) $filtro = $filtro." and t.gid='$tramo'";
	 
	$query_sql = "SELECT id, dias_requeridos, d.nombre departamento, t.nombre_ruta  tramo,
       CASE WHEN (fecha_inicio_real IS NULL) 
               THEN (EXTRACT(DAY FROM age(fecha_fin_prog,now()))-dias_requeridos) 
               ELSE (EXTRACT(DAY FROM age(fecha_inicio_prog,fecha_inicio_real ))-dias_requeridos) 
               END alarma_inicio, 
       EXTRACT(DAY FROM age(fecha_fin_prog,now())) alarma_entrega, iniciado, 
       tendido_a_fecha,km_diseno, empalmes_a_fecha, empalmes_diseno
FROM tramos t left join  asignacion_tramo a on (a.tramo=t.gid), departamentos d
WHERE t.departamento=d.gid ".$filtro." order by d.nombre;"; 		//echo "$query_sql<br>"; 	//echo "Hola<br>";
	$resultado = pg_query($cx,$query_sql) or die(pg_last_error());
	$total_filas = pg_num_rows($resultado);
	//echo $total_filas;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Grodco</title>
<style type="text/css" title="currentStyle">
	@import "./css/style_letra.css";
	@import "./Include/DataTables-1.9.4/media/css/demo_page.css";
	@import "./Include/DataTables-1.9.4/media/css/demo_table.css";
</style>
<script type="text/javascript" language="javascript" src="./Include/DataTables-1.9.4/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="./Include/DataTables-1.9.4/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="./Include/tabla_filtro.js"></script>

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td align="center"><img src="./images/Logo_Grodco.png" width="225" height="100"></td>
    <td align="center"><span class="Letra9">Seguimiento del cronograma</span></td>
  </tr>
</table>



<?php if ($total_filas > 0) { // Show if recordset not empty ?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla">
	<thead>
    <tr>
		  <th align="center">DIAS NECESARIOS</th>
		  <th align="center">DEPARTAMENTO</th>
		  <th align="center">TRAMO</th>
		  <th align="center">ALARMA DE INICIO</th>
		  <th align="center">ALARMA DE ENTREGA</th>
		  <th align="center">INICIADOS</th>
		  <th align="center">TENDIDO A LA FECHA</th>
		  <th align="center">Distancia en Km por  Dise&ntilde;o</th>
		  <th align="center">EMPALMES A LA FECHA</th>
		  <th align="center">EMPALMES POR DISE&Ntilde;O</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($fila = pg_fetch_assoc($resultado)) {
    			$alarma_inicio = $fila['alarma_inicio'];
				$alarma_entrega = $fila['alarma_entrega'];
				$dias_requeridos = $fila['dias_requeridos'];  
    	?>
      <tr>
        <td><?php echo $dias_requeridos; ?></td>
        <td><?php echo utf8_decode($fila['departamento']); ?></td>
        <td><?php echo utf8_decode($fila['tramo']); ?></td>
        <td <?php 
        		if ($alarma_inicio >= $dias_requeridos) echo "style='background:green;color:white;'";
        		if ($alarma_inicio < $dias_requeridos and $alarma_inicio >= 1) echo "style='background:yellow;color:black;'";
				if ($alarma_inicio < 1) echo "style='background:red;color:white;'"; 
        	?> align="right"> <?php echo $alarma_inicio; ?></td>
        <td <?php 
				if ($alarma_entrega > 8) echo "style='background:green;color:white;'";
				if ($alarma_entrega >= 1 and $alarma_entrega <= 8) echo "style='background:yellow;color:black;'";
				if ($alarma_entrega < 1) echo "style='background:red;color:white;'"; 
			?> align="right"><?php echo $alarma_entrega; ?></td>
        <td><?php echo $fila['iniciado']; ?></td>
        <td><?php echo $fila['tendido_a_fecha']; ?></td>
        <td><?php echo $fila['km_diseno']; ?></td>
        <td><?php echo $fila['empalmes_a_fecha']; ?></td>
        <td><?php echo $fila['empalmes_diseno']; ?></td>
      </tr>
       <?php } ?>
       </tbody>
       <tfoot>
		<tr>
        	<th><input type="text" name="Buscar_dias" value="Buscar_dias"  class="Buscar_init" /></th>
			<th><input type="text" name="Buscar_departamento" value="Buscar_departamento" class="Buscar_init" /></th>
			<th><input type="text" name="Buscar_tramo" value="Buscar_tramo" class="Buscar_init" /></th>
			<th><input type="text" name="Buscar_alarma_inicio" value="Buscar_alarma_inicio" class="Buscar_init" /></th>
			<th><input type="text" name="Buscar_alarma_entrega" value="Buscar_alarma_entrega"  class="Buscar_init" /></th>
        	<th><input type="text" name="Buscar_iniciado" value="Buscar_iniciado"  class="Buscar_init" /></th>
			<th><input type="text" name="Buscar_tendido" value="Buscar_tendido" class="Buscar_init" /></th>
			<th><input type="text" name="Buscar_kms_diseño" value="Buscar_kms_diseño" class="Buscar_init" /></th>
			<th><input type="text" name="Buscar_empalmes_fecha" value="Buscar_empalmes_fecha" class="Buscar_init" /></th>
			<th><input type="text" name="Buscar_empalmes_diseño" value="Buscar_empalmes_diseño"  class="Buscar_init" /></th>
		</tr>
	</tfoot>
  </table>
  <?php } // Show if recordset not empty ?>
</body>
</html>
<?php
pg_close($cx);
?>
