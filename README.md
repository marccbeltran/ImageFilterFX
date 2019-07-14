## **Pasos a seguir para la puesta en marcha de la aplicación**

**Levantar el entorno de docker**

Se adjunta archivo docker-compose

docker-compose up -d

---

**Conexión a la BBDD**

**127.0.0.1**  
user: **user**  
password: **password**  
port: **3306**

---

**Creación de la tabla**

CREATE TABLE `images_info` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) NOT NULL DEFAULT '',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tags` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

---

**Descargar dependencias de composer**

composer install

---

**Flushear redis**

docker exec -it docker_redis_1  redis-cli FLUSHALL

---

**funcionamiento de los workers**

Para levantar cada uno de los workers se deberán seguir los pasos siguientes:

 1. Listar containes con el comando ***docker ps***
 2. Acceder al contenedor con ***docker exec -ti [id container] bash***
 3. Ir al path /code 
 4. Acceder a la carpeta de la aplicación
 5. ***ejecutar php work[n].php***

---

**Acceso a la aplicación**

[http://localhost:8080/[nombre_carpeta]/](http://localhost:8080/pfm/)

---

**nota para el archivo elastic.php**

$index->create(array(), true);  //comentar después de la primera ejecución, una vez generado el indice.

---

Se incluye una carpeta samples con imagenes de muestra