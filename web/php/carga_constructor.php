<script>
	$("#opt_cp_constructor").empty();
	$("<option value='0' selected></option>").appendTo("#opt_cp_constructor");
	$("<option value='999999'>TODOS</option>").appendTo("#opt_cp_constructor");
</script>
<?php
	require_once("conexion.php");
	$query_sql = "SELECT * FROM constructores order by nombre"; 						//echo "$query_sql<br>"; //	echo "Hola<br>";
	$resultado = pg_query($cx,$query_sql) or die(pg_last_error());
	$total_filas = pg_num_rows($resultado);									//echo "Filas: $total_filas<br>"; //exit; 
?>
<?php	while ($fila = pg_fetch_assoc($resultado)) {
	$id = $fila['id'];
	$nombre = $fila['nombre'];
	echo "<script>$(\"<option value=\'$id\'>$nombre</option>\").appendTo(\"#opt_cp_constructor\")</script>";
} ?>