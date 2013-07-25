<?php 
header('header("Content-type: text/javascript");');
header('Access-Control-Allow-Origin: *');
require_once("./php/conexion.php"); ?>


<html>
<head>

<!-----SLIDING MENU PANEL----->
<!-----BY: AMIT JAKHU----->
<!-----WWW.AMITJAKHU.COM----->

<!-----META----->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sliding Menu Panel</title>

<!-----STYLESHEETS----- PANEL -->
<link href="css/style_panel.css" rel="stylesheet" type="text/css" />
<!-----STYLESHEETS----- ACORDEON -->
        <link rel="stylesheet" type="text/css" href="css/style_acordeon.css" />
		

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
				<div>
					<input id="ac-1" name="accordion-1" type="radio" checked />
					<label for="ac-1">Seguimiento Cronograma</label>
					<article class="ac-small"><div id="ejecuta_php"></div>
					Seleccione el Grupo:&nbsp;&nbsp;
					<select id="opt_grupo">
						<option value="0" selected></option>	
						<option value="3">3</option>
					</select>	
					<br>Seleccione el Departamento:<br><select id="opt_depto"></select>
					<br>Seleccione el Tramo:<br><select id="opt_tramo"></select>
					</article>
				</div>
				<div>
					<input id="ac-2" name="accordion-1" type="radio" />
					<label for="ac-2">Avance de Obra</label>
					<article class="ac-medium">
						<p>Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded. That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price. </p>
					</article>
				</div>
				<div>
					<input id="ac-3" name="accordion-1" type="radio" />
					<label for="ac-3">Servidumbres</label>
					<article class="ac-large">
						<p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man. </p>
					</article>
				</div>
				<div>
					<input id="ac-4" name="accordion-1" type="radio" />
					<label for="ac-4">Control Pendientes</label>
					<article class="ac-large">
						<p>You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic. </p>
					</article>
				</div>
				<div>
					<input id="ac-5" name="accordion-1" type="radio" />
					<label for="ac-5">Hallazgos</label>
					<article class="ac-large">
						<p>You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic. </p>
					</article>
				</div>
			</section>
        </div>
        <div class="arrow">></div>
</div>
<!-----END SLIDING MENU PANEL----->

<!-----DEMO ONLY----->
<div class="wrapper">

</div>

<div class="footer">
	
</div>

<!-----END DEMO ONLY----->

</body>
</html>
