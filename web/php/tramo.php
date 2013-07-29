<script>
	$("#opt_tramo").empty();
	$("<option value='0' selected></option>").appendTo("#opt_tramo");
	$("<option value='999999'>TODOS</option>").appendTo("#opt_tramo");
</script>
<?php
	require_once("conexion.php");
	$id = $_GET['id'];
	$query_sql = "SELECT * FROM tramos where departamento = '$id' order by nombre_ruta"; 		//echo "$query_sql<br>"; //	echo "Hola<br>";
	$resultado = pg_query($cx,$query_sql) or die(pg_last_error());
	$total_filas = pg_num_rows($resultado);									//echo "Filas: $total_filas<br>"; //exit; 
?>
<?php	while ($fila = pg_fetch_assoc($resultado)) {
			$gid = $fila['gid'];
			$nombre = $fila['nombre_ruta'];
			echo "<script>$(\"<option value=\'$gid\'>$nombre</option>\").appendTo(\"#opt_tramo\")</script>";
		} 
?>