# WebMedia
Guarda y reproduce películas desde un servidor casero, para una red.

Esta pagina esta programada en php y javascript, para poder descargar videos y peliculas y reproducirlas en una red casera, yo lo tengo montado en una raspberry pi con un disco duro externo, y solamente movi la carpeta www de apache al disco duro, hice los cambios necesarios para los permisos y el cambio de ruta y ya puedes usar la web, puedes descargar peliculas y series de la web y almacenarlos en el disco duro y reproducirlos cuando quieras, recomiendo usar el navegador de chrome en dispositivos moviles si quieres transmitir a la tv, al menos para el chromecast me funciona perfecto.
Hay que darle los permisos necesarios a la carpeta html, a mi me funciono con:
sudo chmod -R 755 html
Esto para que pueda descargar videos en las carpetas especificadas.


El estilo CSS no es mio, creditos a quien corresponde, y alguna que otra función.
