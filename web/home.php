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
    setTimeout( function(){$('#menu').css('left','-330px');},4000); <!-- Change 'left' to 'right' for panel to appear to the right -->
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
