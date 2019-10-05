<html>
	<head>
		<title>Peliculas a la carta</title>
	</head>
	<body bgcolor="silver">

	<?php
	function paragrafizar($string="")
	{
        // normalizamos los saltos de línea
        $string = str_replace(array("\r\n", "\r"), "\n", $string);
        // creamos un array de parrafos
        $strParrafos = explode("\n", $string);
        // abrimos tag, deconstruimos el array, cerramos tag
        $string = '<p>' . implode("</p>\n<p>", $strParrafos) . '</p>';
        return $string;
    }
    
    function filtrar_enlaces($cadena_origen="")
    {
    	$cadena_resultante= preg_replace("/((http://i|https://i|https://w|www)[^\s]+)/", '<img src="$1" width=200 height=200>', $cadena_origen);
		$cadena_resultante= preg_replace("/((http|https|www)[^\s]+)/", '<a href="$1">$0</a>', $cadena_origen);
		//miro si hay enlaces con solamente www, si es así le añado el http://
		//$cadena_resultante= preg_replace("/href=\"www/", 'href="http://www', $cadena_resultante);
		//echo '<h3>Cadena filtrada con enlaces normales:</h3>'.$cadena_resultante;
		return $cadena_resultante;
	}
	
	function obtenerCadena($contenido,$inicio,$fin)
	{
		$r = explode($inicio, $contenido);
		if (isset($r[1])){
		    $r = explode($fin, $r[1]);
		    return $r[0];
		}
		return '';
	}
	
	function Obtener_contenidos($source,$inicio='',$final)
	{
		$posicion_inicio = strpos($source, $inicio) + strlen($inicio);
		$posicion_final = strpos($source, $final) - $posicion_inicio;
		$found_text = substr($source, $posicion_inicio, $posicion_final);
		return $inicio . $found_text .$final;
	}

	$url="http://tvpremiumhd.club/hd/peliculas.m3u";
	$source = file_get_contents($url);
	$resultado = paragrafizar(filtrar_enlaces($source));
	echo $resultado;
	
	?>
	</body>
</html>
