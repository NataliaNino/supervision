var db = window.openDatabase("bdmovil", "1.0", "Proyecto Supervisión Azteca", 200000);
var i=0;

function errorCB(err) {
	if (err.code != "undefined" && err.message != "undefined"){
		alert("Error procesando SQL: Codigo: " + err.code + " Mensaje: "+err.message);
	}
}
function successCB() {
    //alert("Ok!");
}

function TBLavance_obra(tx) {//Si no existe crea la talba avance_obra
	tx.executeSql('DROP TABLE IF EXISTS avance_obra');		
    //tx.executeSql('CREATE TABLE IF NOT EXISTS avance_obra (id TEXT,  id_evento TEXT,  tramo TEXT ,  costructor TEXT,  fecha_registro TEXT,  de_punto TEXT,  a_punto TEXT,  herrajes_suspension TEXT,  herrajes_retencion TEXT,  cant_riendas TEXT,  nro_hilos TEXT,  spam TEXT,  abscisa_inicial TEXT,  abscisa_final TEXT,  km_instalados TEXT,  km_detallados TEXT,  puntos_ejec_dia TEXT,  acumulado TEXT,  odf character(2),  optimizado TEXT,  km_supervisados TEXT,  reserva TEXT,  longitud TEXT,  latitud TEXT,  observacion TEXT,  usuario TEXT,  fecha_digitacion TEXT');
	tx.executeSql('CREATE TABLE IF NOT EXISTS avance_obra (id TEXT, nro_hilos TEXT, span TEXT, abscisa_inicial TEXT, abscisa_final TEXT,km_instalados TEXT, km_detallados TEXT, km_supervisados TEXT)');
}

db.transaction(TBLavance_obra);

$(document).ready(function(){
	$("#adicionar").click( function () {	//alert('agregar');		
	i++;
	$("#t_avance").after("<div id='avance"+i+"'> <br><label># Hilos</label><input id='hilos"+i+"' type='text' onkeypress='if (event.keyCode< 48 || event.keyCode > 57) event.returnValue = false;' required /><label>Span</label>	<input id='span"+i+"' type='text' onkeypress='if (event.keyCode< 48 || event.keyCode > 57) event.returnValue = false;' required/><label>Abscisa inicial</label>	<input id='abs_ini"+i+"' type='text' onkeypress='if (event.keyCode< 48 || event.keyCode > 57) event.returnValue = false;' required/><label>Abscisa final</label><input id='abs_fin"+i+"' type='text' onkeypress='if (event.keyCode< 48 || event.keyCode > 57) event.returnValue = false;' required/><label>Km Instalados</label><input id='instalado"+i+"' type='text' onkeypress='if (event.keyCode< 48 || event.keyCode > 57) event.returnValue = false;' required/>	<label>Km Supervisados</label><input id='supervisado"+i+"' type='text' onkeypress='if (event.keyCode< 48 || event.keyCode > 57) event.returnValue = false;' required/><label>Km Detallados</label><input id='detallado"+i+"' type='text' onkeypress='if (event.keyCode< 48 || event.keyCode > 57) event.returnValue = false;' required/><button class='button medium blue_small' id='remover' onclick='remove_avance("+i+")'>--</button></div>")
	
	});
});

$(document).ready(function(){
	$("#guardar").click( function () {	//alert('guardar');	
	
	db.transaction(insert_avance);

	});
});


function remove_avance(j){		
	$("#avance"+j).remove();	
}

function insert_avance(tx){ //alert('insertar');	
	
		for (k = 0; k < i+1; k++){	//alert(k);
			var hilos = $("#hilos"+k).val();
			var span = $("#span"+k).val();
			var abs_inicial = $("#abs_ini"+k).val();
			var abs_final = $("#abs_fin"+k).val();
			var instalados = $("#instalado"+k).val();
			var supervisados = $("#supervisado"+k).val();
			var detallados = $("#detallado"+k).val();
			//alert(hilos);
			//alert('INSERT INTO avance_obra (nro_hilos,span,abscisa_inicial,abscisa_final,km_instalados,km_supervisados,km_detallados) values ("'+hilos+'","'+span+'","'+abs_inicial+'","'+abs_final+'","'+instalados+'","'+supervisados+'","'+detallados+'")');
			tx.executeSql('INSERT INTO avance_obra (nro_hilos,span,abscisa_inicial,abscisa_final,km_instalados,km_supervisados,km_detallados) values ("'+hilos+'","'+span+'","'+abs_inicial+'","'+abs_final+'","'+instalados+'","'+supervisados+'","'+detallados+'")');
		}
}

