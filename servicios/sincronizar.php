<?php 
header('header("Content-type: text/javascript");');
header('Access-Control-Allow-Origin: *');
require_once("conexion.php"); ?>

<?php
if ($_POST['tabla'] == "lista_chequeo"){				/*	echo "Tabla: ".$_POST['tabla']."   Cod Env&iacute;o: ".$_POST['id']."   Tramo: ".$_POST['tramo']."   constructor: ".$_POST['constructor']."   fecha_supervision: ".$_POST['fecha_supervision']."   usuario: ".$_POST['usuario']."   item: ".$_POST['item']."   respuesta: ".$_POST['respuesta']."   observacion: ".$_POST['observacion']."<br>"; */
/*	$id_envio = $_POST['id'];
	$item = $_POST['item'];
	$tramo = $_POST['tramo'];
	$constructor = $_POST['constructor'];
	$fecha_supervision = $_POST['fecha_supervision'];
	$usuario = $_POST['usuario'];
	$respuesta = $_POST['respuesta'];
	$observacion =$_POST['observacion'];
	//VERIFICA SI LA LISTA DE CHEQUEO EXISTE
	$query_sql2 = "select count(*) from lista_chequeo where id_envio like '$id_envio'"; 	
	$resultado2 = pg_query($cx,$query_sql2) or die('No pudo conectarse ');
	$arr_num_reg = pg_fetch_array($resultado2, 0, PGSQL_NUM);
	$reg_encontrados =  $arr_num_reg[0];							//$total_filas2 = pg_num_rows($resultado2);		//echo "$query_sql2"."      Filas: $reg_encontrados<br>";											//echo "Filas: $reg_encontrados<br>";	
	if ($reg_encontrados == 0){	//SI NO EXISTE LA LISTA DE CHEQUEO CREA EL REGISTRO EN LA BASE DE DATOS
		$query_sql_add = "insert into lista_chequeo (tramo,constructor,fecha_supervision,usuario, fecha_envio,id_envio) values ('$tramo','$constructor','$fecha_supervision','$usuario',now(),'$id_envio')"; //echo "$query_sql<br>";
		pg_query($cx,$query_sql_add) or die('No pudo conectarse '); 
		unset($query_sql_add);
		pg_query($cx, "COMMIT;"); 
	}
	$query_sql3 = "select lc.id from lista_chequeo lc where id_envio = '$id_envio'";
	$resultado3 = pg_query($cx,$query_sql3) or die('No pudo conectarse ');	//CONSULTA DE NUEVO EL ID DE LA TABLA "lista_chequeo"
	$arr = pg_fetch_array($resultado3, 0, PGSQL_NUM); 		//TRAE EL PRIMER REGISTRO
	$id_lista =  $arr[0];									//ALMACENA EL ID EN UNA VARIABLE LOCAL
	//ALMACENA LA RESPUESTA EN LA BASE DE DATOS
	$query_sql_rt = "insert into lista_chequeo_rtas (id_lista,item,respuesta,observacion,id_envio) values ('$id_lista','$item','$respuesta','$observacion','$id_envio')"; //echo "$query_sql<br>";
	pg_query($cx,$query_sql_rt) or die('No pudo conectarse '); 
	
	echo $item;
	pg_close($cx); */

}elseif ($_POST['tabla'] == "control_hallazgos"){
	
	$id_envio = $_POST['id'];
	$id_item = $_POST['id_item'];
	$tramo = $_POST['tramo'];
	$constructor = $_POST['constructor'];
	$usuario = $_POST['usuario'];
	$usuario_cierre = $_POST['usuario_cierre'];
	$fecha_registro = $_POST['fecha_registro'];
	$fecha_cierre = $_POST['fecha_cierre'];
	$foto_registro = $_POST['foto_registro'];
		if (isset($foto_registro)){
			$decoded=base64_decode($foto_registro);
			file_put_contents('fotos/Hallazgos_apertura.JPG',$decoded);
		}
	$foto_cierre = $_POST['foto_cierre'];
		if (isset($foto_cierre)){
			$decoded=base64_decode($foto_cierre);
			file_put_contents('fotos/Hallazgos_cierre.JPG',$decoded);
		}
	$registro_longitud = $_POST['registro_longitud'];		if($registro_longitud == "") {$registro_longitud='null';}
	$registro_latitud = $_POST['registro_latitud'];			if($registro_latitud == "") {$registro_latitud='null';}
	$registro_exactitud = $_POST['registro_exactitud'];		if($registro_exactitud == "") {$registro_exactitud='null';}
	$cierre_longitud = $_POST['cierre_longitud'];			if($cierre_longitud == "") {$cierre_longitud='null';}
	$cierre_latitud = $_POST['cierre_latitud'];				if($cierre_latitud == "") {$cierre_latitud='null';}
	$cierre_exactitud = $_POST['cierre_exactitud'];			if($cierre_exactitud == "") {$cierre_exactitud='null';}
	$estado = $_POST['estado'];
	$observacion = $_POST['observacion'];
	$observacion_cierre = $_POST['observacion_cierre'];

	//VERIFICA SI EL HALLAZGO EXISTE
	$query_sql2 = "select count(*) from control_hallazgos where id_envio = '$id_envio' and id_item = '$id_item'";
	$resultado2 = pg_query($cx,$query_sql2) or die(pg_last_error());
	$arr_num_reg = pg_fetch_array($resultado2, 0, PGSQL_NUM);
	$reg_encontrados =  $arr_num_reg[0];	
	if ($reg_encontrados == 0){	//SI NO EXISTE EL HALLAZGO, CREA EL REGISTRO EN LA BASE DE DATOS			//echo $query_sql_add;
		$query_sql_add = "insert into control_hallazgos (id_item,tramo,usuario,observacion,registro_longitud,registro_latitud,registro_exactitud,estado,id_envio,fecha_registro) values ('$id_item','$tramo','$usuario','$observacion',$registro_longitud,$registro_latitud,$registro_exactitud,'$estado','$id_envio','$fecha_registro')"; //echo "$query_sql<br>";	
		pg_query($cx,$query_sql_add) or die(pg_last_error()); 
		unset($query_sql_add);
		pg_query($cx, "COMMIT;"); 
	}
	else{				
		if ($estado == "CERRADO"){
			$query_sql_add = "update control_hallazgos set fecha_cierre='$fecha_cierre', usuario_cierre='$usuario', observacion_cierre='$observacion_cierre', estado='$estado' where id_envio = '$id_envio' and id_item = '$id_item'"; //echo "$query_sql_add;<br>";		
			pg_query($cx,$query_sql_add) or die(pg_last_error()); 
			unset($query_sql_add);
			pg_query($cx, "COMMIT;");
			echo $id_item;
		}
	}
	pg_close($cx); 
}elseif ($_POST['tabla'] == "control_de_pendientes"){		//PENDIENTES	PENDIENTES	PENDIENTES	PENDIENTES	PENDIENTES	PENDIENTES	PENDIENTES
	$id_envio = $_POST['id'];
	$tipo_pendiente = $_POST['tipo_pendiente'];
	$tramo = $_POST['tramo'];
	$constructor = $_POST['constructor'];
	$usuario = $_POST['usuario'];
	$usuario_cierre = $_POST['usuario_cierre'];
	$fecha_registro = $_POST['fecha_registro'];
	$fecha_cierre = $_POST['fecha_cierre'];
	$foto_registro = $_POST['foto_registro'];
		if (isset($foto_registro)){
			$decoded=base64_decode($foto_registro);
			file_put_contents('fotos/Pendientes_apertura.JPG',$decoded);
		}
	$foto_cierre = $_POST['foto_cierre'];
		if (isset($foto_cierre)){
			$decoded=base64_decode($foto_cierre);
			file_put_contents('fotos/Pendientes_cierre.JPG',$decoded);
		}
	$registro_longitud = $_POST['registro_longitud'];		if($registro_longitud == "") {$registro_longitud='null';}
	$registro_latitud = $_POST['registro_latitud'];			if($registro_latitud == "") {$registro_latitud='null';}
	$registro_exactitud = $_POST['registro_exactitud'];		if($registro_exactitud == "") {$registro_exactitud='null';}
	$cierre_longitud = $_POST['cierre_longitud'];			if($cierre_longitud == "") {$cierre_longitud='null';}
	$cierre_latitud = $_POST['cierre_latitud'];				if($cierre_latitud == "") {$cierre_latitud='null';}
	$cierre_exactitud = $_POST['cierre_exactitud'];			if($cierre_exactitud == "") {$cierre_exactitud='null';}
	$estado = $_POST['estado'];
	$observacion = $_POST['observacion'];
	$observacion_cierre = $_POST['observacion_cierre'];
	
	
	//VERIFICA SI EL HALLAZGO EXISTE
	$query_sql2 = "select count(*) from control_de_pendientes where id_envio = '$id_envio' and tipo_pendiente = '$tipo_pendiente'"; 	
	$resultado2 = pg_query($cx,$query_sql2) or die(pg_last_error());
	$arr_num_reg = pg_fetch_array($resultado2, 0, PGSQL_NUM);
	$reg_encontrados =  $arr_num_reg[0];	
	if ($reg_encontrados == 0){	//SI NO EXISTE EL HALLAZGO, CREA EL REGISTRO EN LA BASE DE DATOS			//echo $query_sql_add;
		$query_sql_add = "insert into control_de_pendientes (tipo_pendiente,tramo,constructor,usuario,observacion,registro_longitud,registro_latitud,registro_exactitud,estado,id_envio,fecha_registro) values ('$tipo_pendiente','$tramo','$constructor','$usuario','$observacion',$registro_longitud,$registro_latitud,$registro_exactitud,'$estado','$id_envio','$fecha_registro')"; //echo "$query_sql<br>";	
		pg_query($cx,$query_sql_add) or die(pg_last_error()); 
		unset($query_sql_add);
		pg_query($cx, "COMMIT;"); 
	}
	else{				//echo $query_sql_add;
		if ($estado == "CERRADO"){
			$query_sql_add = "update control_de_pendientes set fecha_cierre='$fecha_cierre', usuario_cierre='$usuario', observacion_cierre='$observacion_cierre', estado='$estado' where id_envio = '$id_envio' and tipo_pendiente = '$tipo_pendiente'"; echo "$query_sql_add;<br>";		
			pg_query($cx,$query_sql_add) or die(pg_last_error()); 
			unset($query_sql_add);
			pg_query($cx, "COMMIT;");
			echo $tipo_pendiente;
		}
	}
	pg_close($cx); 
}
?>