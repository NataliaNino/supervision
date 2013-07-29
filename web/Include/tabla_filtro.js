var asInitVals = new Array();

$(document).ready(function(){
	
/* $('#example').dataTable({
	
	}); */
	
	var oTable = $('#tabla').dataTable( {
		"oLanguage": {
			"sSearch": "Buscar:",
			"sInfo": "Total _TOTAL_ registros (_START_ a _END_)",
			"sLengthMenu": "Mostrando _MENU_ Registros",
			"oPaginate": {
			        "sFirst": "Primera",
			        "sLast": "Última",
			        "sNext": "Siguiente",
			        "sPrevious": "Anterior"
			      }
		},"iDisplayLength": -1,
		"aaSorting": [[ 0, "desc" ]],
	"sPaginationType": "full_numbers",
	"aLengthMenu": [[ -1,10,20,50,100], [ "Todos",10,20,50,100]]
	} );

		$("tfoot input").keyup( function () {
		/* Filter on the column (the index) of this element */
		oTable.fnFilter( this.value, $("tfoot input").index(this) );
	} );

	/*
	 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
	 * the footer
	 */
	$("tfoot input").each( function (i) {
		asInitVals[i] = this.value;
	} );
	
	$("tfoot input").focus( function () {
		if ( this.className == "search_init" )
		{
			this.className = "";
			this.value = "";
		}
	} );
	
	$("tfoot input").blur( function (i) {
		if ( this.value == "" )
		{
			this.className = "search_init";
			this.value = asInitVals[$("tfoot input").index(this)];
		}
	} );
});