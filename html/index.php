<html>
	<head>
		<link rel="stylesheet" href="main.css" />
		<title>Servidor multimedia</title>

		<script src="http://code.jquery.com/jquery-latest.js"></script>
	    <script type="text/javascript">
		function actualizavideo(url)
		{
			this.url = url;
			var v = document.getElementById("videouno");
			var reproducc = document.getElementById("reproducc");
			var subb_en = document.getElementById("sub_en");
			var subb_es = document.getElementById("sub_es");
			reproducc.src = this.url;
			
			if(this.url.indexOf("series") != -1)
			{
				var subCadena = this.url.substring(7);
				subb_en.src = "series/subtitulos/" + subCadena + "_en.vtt";
				subb_es.src = "series/subtitulos/" + subCadena + "_es.vtt";
			}
			
			if(this.url.indexOf("videos") != -1)
			{
				var subCadena = this.url.substring(7);
				subb_en.src = "videos/subtitulos/" + subCadena + "_en.vtt";
				subb_es.src = "videos/subtitulos/" + subCadena + "_es.vtt";
			}
			
			v.load();
			v.play();
			window.location = "#header";
			document.getElementById("tituloa").innerHTML = this.url;
		}
		</script>
	</head>
	<body>
		<header id="header" class="alt"><h1>Peliculas y series.</h1></header>
		<section id="main" class="container">
		<section class="box special">
		<header class="major">
			
			<?php
				$ip = $_SERVER["REMOTE_ADDR"];
				$fecha = date("Y-m-d;h:i:s");
				$sistema = $_SERVER['HTTP_USER_AGENT'];
				$log = "IP: $ip - Fecha: $fecha - Sistema: $sistema\r\n";
				$fp = fopen("log.txt", "a");
				fwrite($fp, $log);
				fclose($fp);
				
				$salida = shell_exec('cat /sys/class/thermal/thermal_zone0/temp');
				$salida = $salida / 1000;
				$pila1 = array();
				$pila2 = array();
				$directorio = opendir("videos/");
				while($elemento = readdir($directorio))
				{
					if($elemento != '.' && $elemento != '..')
					{
						array_push($pila1, $elemento);
					}
				}
				sort($pila1, 0);
				$directorio = opendir("series/");
				while($elemento = readdir($directorio))
				{
					if($elemento != '.' && $elemento != '..')
					{
						array_push($pila2, $elemento);
					}
				}
				sort($pila1, 0);
				sort($pila2, 0);
				/*$cont = 0;
				foreach($pila as $value)
				{
					echo "<font size=10><a href='videos/$pila[$cont]' target='_blank'>$pila[$cont]</a></font><br><br>";
					$cont++;
				}
				
				Convertir subtitulos str a vtt:
				https://atelier.u-sub.net/srt2vtt/
				
				Descarga de subtitulos:
				http://es.tvsubtitles.net/tvshow-110-3.html
				*/
			?>
			<h1 id="tituloa">Selecciona un archivo de la lista. </h1>
			<?php
			/*
			$enlace = mysqli_connect("localhost", "root", "root", "series");

			if (!$enlace) {
				echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
				echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
				echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
				exit;
			}

			//echo "Conectado correctamente. Información del host: " . mysqli_get_host_info($enlace) . PHP_EOL;


			$consulta = "SELECT * FROM series";
				
			$resultado = mysqli_query( $enlace, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");

			echo "<table border=1>";
			echo "<tr bgcolor='red'>";
			echo "<td>id</td>";
			echo "<td>nombre de la tarea</td>";
			echo "</tr>";
			while ($columna = mysqli_fetch_array( $resultado ))
			{
			 echo "<tr>";
			 echo "<td>" . $columna['ip'] . "</td><td>" . $columna['nombre'] ."</td>";
			 echo "</tr>";
			}
			echo "</table>";

			mysqli_close($enlace);*/
			?>

			<video poster="fondo.jpg" width="100%" height="480"  id="videouno" preload="auto" controls>
				<track label="English" kind="subtitles" id="sub_en" srclang="en" src="" default>
				<track label="Español" kind="subtitles" id="sub_es" srclang="es" src="">
				<source src="" type="video/mp4" id="reproducc">
				Your browser does not support the video tag.
			</video> 
			<section class="box special features">
				<div class="features-row">
					<section>
						<h3>Peliculas</h3>
						<p><ul class="alt">
						<?php
							$cont = 0;
							foreach($pila1 as $value)
							{
								//echo "<a href='videos/$pila1[$cont]' target='_blank'>$pila1[$cont]</a><br><br>";
								echo "<li style='cursor: hand' onclick=actualizavideo('videos/$pila1[$cont]');>$pila1[$cont]</li>";
								$cont++;
							}				
						?>	
						</ul></p>
					</section>
					<section>
						<h3>Series</h3>
						<p><ul class="alt">
						<?php
							$cont = 0;
							foreach($pila2 as $value)
							{
								//echo "<a href='series/$pila2[$cont]' target='_blank'>$pila2[$cont]</a><br><br>";
								echo "<li style='cursor: hand' onclick=actualizavideo('series/$pila2[$cont]');>$pila2[$cont]</li>";
								$cont++;
							}				
						?>		
						</ul></p>
					</section>
				</div>
			</section>
			<br><br>
			<a href="tv.php" target='_blank'>Lista de mas peliculas</a>
			<a href="http://gnula.nu/peliculas/lista-de-peliculas-recomendadas/" target='_blank'>Link de peliculas en internet</a>
			<a href="http://pelisplus.co" target='_blank'>link de pelisplus</a>
			<form action="descarga.php" method="post" name="datos">
				Nombre de salida: <input name="nombre" type="text" id="nombre" value="" /><br>
				URL: <input type="text" name="url" id="url" /><br>
				<div class="select-wrapper">
					<select name="category" id="category">
						<option value="1">Serie</option>
						<option value="2">Pelicula</option>
					</select>
				</div><br>
				<input type="submit" name="ok" id="ok" value="Agregar" />
				<input type="reset" name="reset" id="reset" value="Limpiar" />
			</form>
			<div id="feedback-bg-info">
			<?php 
				echo "Temperatura del servidor: $salida C<br>";
				$wgetpro = shell_exec('pidof wget');
				$countt = 0;
				for($i=0;$i<strlen($wgetpro);$i++)
				{
					if($wgetpro{$i} === " ")
						$countt++;
				}
				if($i >= 2)
					$countt++;
				echo "Descargas actuales: $countt";
				
			?>
			</div>


		</header>
		</section>
		</section>		
	</body>
</html>
