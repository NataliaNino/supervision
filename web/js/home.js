/**
 * @author Usuario
 */
$(document).ready(function(){
	$("#opt_grupo").change(function () {
		var id = $(this).val();
		$("#ejecuta_php").load('./php/carga_depto.php?id='+id);
	})
	$("#opt_depto").change(function () {
		var id = $(this).val();
		$("#ejecuta_php").load('./php/tramo.php?id='+id);			
	})
})
