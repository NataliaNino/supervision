/**
 * @author Usuario
 */
$(window).load(function() {
      $("#ejecuta_cp_php").load('./php/carga_constructor.php');
});

$(document).ready(function(){
	$("#opt_grupo").change(function () {
		var id = $(this).val();
		$("#ejecuta_php").load('./php/carga_depto.php?id='+id);
	});
	$("#opt_depto").change(function () {
		var id = $(this).val();
		$("#ejecuta_php").load('./php/tramo.php?id='+id);			
	});
	$("#btn_grdar_seguimiento").click(function () {
		if($("#opt_grupo").val()=="0"){
			alert("Seleccione el Grupo por favor!");
			height: ;
			$("#menu").css({'left':'0px'});	//$("#menu").focus();
			$("#opt_grupo").focus();	
			return false;	
		}
		if($("#opt_depto").val()=="0"){
			alert("Seleccione el Departamento!");
			$("#menu").css({'left':'0px'});//$("#menu").css({'left':''});
			$("#opt_depto").focus();
			return false;	
		}
		if($("#opt_tramo").val()=="0"){
			alert("Seleccione el Tramo!");
			$("#menu").css({'left':'0px'});
			$("#opt_tramo").focus();
			return false;	
		}	
		$('#menu').css('left','-330px');	
		var Vopt_grupo = $("#opt_grupo").val();
		var Vopt_depto = $("#opt_depto").val();
		var Vopt_tramo = $("#opt_tramo").val();
		$("#centro").load('./php/seguimiento_cronograma.php?depto='+Vopt_depto+'&tramo='+Vopt_tramo);
			
	});
	$("#btn_cons_cp").click(function () {
		var Vconstructor = $("#opt_cp_constructor").val();
		if(Vconstructor=="0"){
				alert("Seleccione el Constructor!");
				$("#menu").css({'left':'0px'});
				$("#opt_cp_constructor").focus();
				return false;	
			}	
		if(Vconstructor==0 || Vconstructor==999999){
			$("#centro").load('./php/gr_pendientes_constructores.php');
		}else{
			$("#centro").load('./php/gr_pendientes_x_constructor.php?constructor='+Vconstructor);
		}		
	});
	$("#btn_cons_cp_prom").click(function () {
		$("#centro").load('./php/gr_pendientes_constructor_dias.php');
	});

	$('#f_inicio').focus(function() {
		$('#menu').css('left','0px');
	});

	$('#f_final').focus(function() {
		$('#menu').css('left','0px');
	});
	$("#btn_cons_envios").click(function () {
		var fecha_ini = $("#f_inicio").val(); //alert(fecha_ini);
		var fecha_fin = $("#f_final").val();
		if(fecha_ini=="" || fecha_ini==null){
				alert("Seleccione una fecha de Inicio!");
				$("#f_inicio").focus();
				return false;
		}
		if(fecha_fin== "" || fecha_fin==null){
				alert("Seleccione una fecha Final!");
				$("#f_final").focus();
				return false;
		}		
		$('#menu').css('left','-330px');
	});	
	btn_cons_envios
});