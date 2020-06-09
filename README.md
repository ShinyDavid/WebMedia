# WebMedia
Guarda y reproduce películas desde un servidor casero, para una red, cargadas desde una pagina web accesible desde todos tus dispositivos.

Este proyecto surge a partir de la necesidad poder descargar series o peliculas desde internet para poder visualizarlas mas tarde, ya sea por que por problemas del servidor se satura y se puede caer la pagina cuando la quieres ver o por que la conexión no cumple con los requisitos para poder reproducir continuamente la pelicula sin altos.

La visualización es sencilla pero eficiente, actualmente se trabaja en el guardado del tiempo actual de la pelicula o serie que estas viendo por si por cualquier razón dejas de verla puedas continuar posteriormente donde te quedaste sin problemas, y darle continuidad en el caso de una serie en el capitulo actual sin necesidad de buscarlo.

El Hadware necesario es minimo, la maquina puede ser x64-x86 o arquitectura ARM, lo escencial es poder correr el proceso de apache para estos fines, por ejemplo en una raspberry pi u otro hadware que sea conveniente el costo (energetico) vs rendimiento, se deja a eleccion del usuario.

Primero se debe instalar Apache y PHP (aunque se puede usar XAMPP para windows o LAMP para linux recomiendo la instalación pura de apache y php).
sudo apt -y install apache2
sudo apt -y install php

Posterior a esto debemos poner el contenido del repositorio en la carpeta html, e ingresar a la ip registrada del servidor.
Las configuraciones del servidor dependen de las necesidades de cada usuario, sin embargo recomiendo que para grande almacenamiento multimedia se instale un nuevo disco duro de considerable capacidad y cambiar la carpeta html a el disco duro, editando el archivo

/etc/apache2/apache2.conf

Comentando la siguiente linea con el simbolo "#" ( o modificandola al directorio especificado ) y ajustando los demas parametros según se requiera.

# <Directory /var/www/>
<Directory /home/jonathan/www/>
	Options Indexes FollowSymLinks
	AllowOverride None
	Allow from all
	Require all granted
</Directory>

Por ultimo se guardan los cambios (Me parece que es necesario abrir previamente el archivo con privilegios de root), luego aplicamos el comando:

sudo chmod -R 755 html

Esto para no tener problemas con la escritura y lectura en el directorio.
Para finalizar solamente reiniciamos el servidor apache

sudo /etc/init.d/apache2 restart

El estilo CSS no es mio, creditos a quien corresponde, y alguna que otra función.
