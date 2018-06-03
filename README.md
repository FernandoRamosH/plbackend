
Prueba técnica futbol (Repositorio BackEnd)  
=========  
[![Build Status](https://travis-ci.org/FernandoRamosH/plbackend.svg?branch=master)](https://travis-ci.org/FernandoRamosH/plbackend)  
  
Este proyecto consiste en una API REST en la que se pueden listar clubes y los jugadores de un club. Además también se pueden crear nuevos jugadores para un club concreto.  
  
Este proyecto ha sido desarrollado usando:  
      
- PHP 7.1  
- Symfony 3.4  
- Travis CI  
- MySQL  
- Postman  
  
Demo Server  
------------  
Se puede probar la API sin necesidad de instalar nada desde el servidor de demo: plbackend.fernandoramos.eu  
  
Llamadas de ejemplo:  
  
[http://plbackend.fernandoramos.eu/api/v1/teams](http://plbackend.fernandoramos.eu/api/v1/teams)  
  
[http://plbackend.fernandoramos.eu/api/v1/team/16](http://plbackend.fernandoramos.eu/api/v1/team/16)  
  
  
Documentación de la API  
------------  
La documentación de la API se ha generado con POSTMAN y es accesible desde el siguiente enlace:  
   
 [Ver documentación de la API ](https://documenter.getpostman.com/view/2999034/apifutbolbackend/RW8FFmBM)  
  
Instalación  
------------  
  
  
```bash  
composer install  
```  
Rellenar en el archivo _app/config/parameters.yml_ los parámetros de conexión a la BD.  Ejecutar:
```bash  
php bin/console doctrine:database:create  
php bin/console doctrine:schema:create  
php bin/console doctrine:fixtures:load  
```  
  
Testing  
------------  
Este proyecto tiene pruebas funcionales para cada controlador en la carpeta *tests/*. Para pasar los tests ejecutar:  
```bash  
./vendor/bin/simple-phpunit  
```  
  
Se ha conectado el repositorio con la herramienta de integración continua Travis CI. De forma que en cada push a este repositorio se pasan automáticamente todos los tests. Se puede ver los resultados en:  
  
https://travis-ci.org/FernandoRamosH/plbackend  
  
  
[![Build Status](https://travis-ci.org/FernandoRamosH/plbackend.svg?branch=master)](https://travis-ci.org/FernandoRamosH/plbackend)