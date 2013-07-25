<?php
	require_once("conexion.php");
	$id = $_GET['id'];
	$query_sql = "SELECT * FROM departamentos where grupo = '$id' order by nombre"; 						//echo "$query_sql<br>"; //	echo "Hola<br>";
	$resultado = pg_query($cx,$query_sql) or die(pg_last_error());
	$total_filas = pg_num_rows($resultado);									//echo "Filas: $total_filas<br>"; //exit; 
?>
<script>
	$("#opt_depto").empty();
	$("<option value='0'>TODOS</option>").appendTo("#opt_depto");
</script>
<?php	while ($fila = pg_fetch_assoc($resultado)) {
	$gid = $fila['gid'];
	$nombre = $fila['nombre'];
	echo "<script>$(\"<option value=\'$gid\'>$nombre</option>\").appendTo(\"#opt_depto\")</script>";
} ?>