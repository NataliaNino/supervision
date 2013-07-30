<?php 
header('header("Content-type: text/javascript");');
header('Access-Control-Allow-Origin: *');
require_once("./php/conexion.php"); ?>


<html>
<head>

<!-----SLIDING MENU PANEL----->

<!-----META----->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sliding Menu Panel</title>

<!-----STYLESHEETS----- PANEL -->
<link href="css/style_panel.css" rel="stylesheet" type="text/css" />
<!-----STYLESHEETS----- ACORDEON -->
        <link rel="stylesheet" type="text/css" href="css/style_acordeon.css" />
        <link rel="stylesheet" type="text/css" href="css/estilo_boton.css" />
		

<!-----SCRIPTS----->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="css/estilo_fecha.css" />
<!-----SCRIPTS ACORDEON----->
<script type="text/javascript" src="js/modernizr.custom.29473.js"></script>
<script type="text/javascript" src="js/home.js"></script>

<!-----SLIDING PANEL HEIGHT ADJUST TO DOCUMENT HEIGHT----->
<script type="text/javascript">
$(document).ready(function() {
	$("#menu").height($(document).height());
});
</script>

<!-----SLIDING PANEL DELAY AND HIDE----->
<script type="text/javascript">
$(document).ready(function() {
    setTimeout( function(){$('#menu').css('left','-330px');},2000); <!-- Change 'left' to 'right' for panel to appear to the right -->
});
</script>
  <script>
  $(function() {
  	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',

		currentText: 'Hoy',
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
		'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
		'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié;', 'Juv', 'Vie', 'Sáb'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
		weekHeader: 'Sm',
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
	};
$.datepicker.setDefaults($.datepicker.regional['es']);
    $( "#f_inicio" ).datepicker();
    $( "#f_final" ).datepicker();
  });
  </script>
</head>

<body>

<!-----SLIDING MENU PANEL----->
<div id="menu">
        <div class="container">
			<section class="ac-container">
<!--				<div>
					<input id="ac-1" name="accordion-1" type="radio" checked/>
					<label for="ac-1">SUPERVISI&Oacute;N FIBRA &Oacute;PTICA</label>
					Aplicacativo de administración de supervision de fibra optica<br><br>
				</div>  -->
				<div>
					<input id="ac-1" name="accordion-1" type="radio" />
					<label for="ac-1">Seguimiento Cronograma</label>
					<article class="ac-small"><div id="ejecuta_php"></div>
					Seleccione el Grupo:&nbsp;&nbsp;
					<select id="opt_grupo">
						<option value="0" selected></option>	
						<option value="3">3</option>
					</select>	
					<br>Seleccione el Departamento:<br><select id="opt_depto"></select>
					<br>Seleccione el Tramo:<br><select id="opt_tramo"></select>
					<br><a class="button medium blue" id="btn_grdar_seguimiento">Consultar</a>
					</article>
				</div>
				<div>
					<input id="ac-2" name="accordion-1" type="radio" />
					<label for="ac-2">Avance de Obra</label>

				</div>
				<div>
					<input id="ac-3" name="accordion-1" type="radio" />
					<label for="ac-3">Servidumbres</label>

				</div>
				<div>
					<input id="ac-4" name="accordion-1" type="radio" />
					<label for="ac-4">Servidumbres</label>

				</div>
				<div>
					<input id="ac-5" name="accordion-1" type="radio" />
					<label for="ac-5">Control Pendientes</label>
					<article class="ac-small"><div id="ejecuta_cp_php"></div>
					Seleccione el CONSTRUCTOR:&nbsp;&nbsp;
					<select id="opt_cp_constructor"></select>	
					<br><a class="button medium blue" id="btn_cons_cp">Consulta Pendientes</a>
					<br><a class="button medium blue" id="btn_cons_cp_prom">Consulta Tiempo Promedio</a>
					</article>
				</div>
				<div>
					<input id="ac-6" name="accordion-1" type="radio" />
					<label for="ac-6">Hallazgos</label>
					<article class="ac-large">
						
					</article>
				</div>
				<div>
					<input id="ac-7" name="accordion-1" type="radio" />
					<label for="ac-7">Control Envío</label>
					<article class="ac-large">
						Fecha Inicio: <input type="text" id="f_inicio" style="display: block;background: #E3E3E3;"/>
					  	Fecha Final: <input type="text" id="f_final" style="display: block;background: #E3E3E3;"/>
						<br><a class="button medium blue" id="btn_cons_envios">Consulta Envíos</a>
					</article>
				</div>
			</section>
        </div>
        <div class="arrow">></div>
</div>
<!-----END SLIDING MENU PANEL----->

<!-----DEMO ONLY----->
<div  id="centro" align="center" ></div>

<div class="footer">
	
</div>

<!-----END DEMO ONLY----->

</body>
</html>
