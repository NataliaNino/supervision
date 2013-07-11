/**
 * @author juan.garzon 2013-JUN-20
 */
	var nombre_supervisor = sessionStorage.getItem("nombre");
 	var nombre_tramo = sessionStorage.getItem("nom_tramo");
 	var nombre_constructor = sessionStorage.getItem("nom_constructor");
 $("#n_supervisor").html("<strong>Supervisor: "+nombre_supervisor+"</strong><br>");
 $("#n_constructor").html("<strong>Constructor: "+nombre_constructor+"</strong>");
 $("#n_tramo").html("<strong>Tramo: "+nombre_tramo+"</strong><br><br><br>");					//$("#menu").html('<a data-role="button" data-theme="a">AFSDFASDF</a>');  //data-icon="arrow-r" data-iconpos="right"//$("#menu").html('<select name="constructor" id="constructor" data-native-menu="true"></select><br>');
	
var db = window.openDatabase("bdmovil", "1.0", "Proyecto Supervisión Azteca", 200000);

function errorCB(err) {
	// Esto se puede ir a un Log de Error dir�a el purista de la oficina, pero como este es un ejemplo pongo el MessageBox.Show :P
	if (err.code === undefined || err.message == "undefined"){
		alert("No hay información pendiente de envío");
		window.location = "menu_principal.html";
	}else
	{
		alert("Error procesando SQL: Codigo: " + err.code + " Mensaje: "+err.message);		
	}
}

function ConsultaSincronizar(tx) {
	tx.executeSql('SELECT * FROM lista_chequeo_rtas', [], ConsultaSincronizarCarga,errorCB);
}
function ConsultaSincronizarCarga(tx, results) {
	var len = results.rows.length;									//alert(len);
	//if (len == 0) alert("No hay información pendiente de envío");
	for (i = 0; i < len; i++){
		var parametros = new Object();
		parametros['tabla'] = 'lista_chequeo';
		parametros['id'] = results.rows.item(i).id;
		parametros['tramo'] = results.rows.item(i).tramo;
		parametros['constructor'] = results.rows.item(i).constructor;
		parametros['fecha_supervision'] = results.rows.item(i).fecha_supervision;
		parametros['usuario'] = results.rows.item(i).usuario;
		parametros['item'] = results.rows.item(i).item;
		parametros['respuesta'] = results.rows.item(i).respuesta;
		parametros['observacion'] = results.rows.item(i).observacion;
		var id_guardar = results.rows.item(i).id;

		$.ajax({
			data:  parametros,
			url:'http://200.21.69.126:8088/supervision_fibra_optica/servicios/sincronizar.php?',//url:'http://localhost:808/servicios/logueo.php?usr='+usr+'&pas='+pas,
			type:  'post',
		    beforeSend: function () {
		            $("#resultado").html("Procesando, espere por favor...");
		    },
			success: function(response){
				$("#resultado").before(response);
				db.transaction(function(tx) {
				var item_rta = response.trim();			//alert(item_rta);	//alert(id_guardar +'   ----   '+ response);	//alert(item_rta);
		          tx.executeSql('DELETE from lista_chequeo_rtas where id = "'+id_guardar+'" and item = "'+item_rta+'"');
		        });
			},
			error: function (error) {
				$("#resultado").text('Error');
		    }
		})
	
   	}
	alert("Sincronización Exitosa");
	window.location = "menu_principal.html";
   	
}	//$(document).ready(function(){ })
// CARGAR MENU DE LA BASE DE DATOS
db.transaction(ConsultaSincronizar);
