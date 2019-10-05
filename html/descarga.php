<?php
	$category = $_POST['category'];
	if($category == 2)
	{
		$texto = "wget ".$_POST['url']." -O ./videos/".$_POST['nombre'].".mp4 -b";
		echo $texto;
		$salida = shell_exec($texto);
	}
	else if($category == 1)
	{
		$texto = "wget ".$_POST['url']." -O ./series/".$_POST['nombre'].".mp4 -b";
		echo $texto;
		$salida = shell_exec($texto);
	}
	echo "salida: $salida";
	header("Location: index.php");
?>

