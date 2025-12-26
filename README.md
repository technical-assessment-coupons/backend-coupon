### START PROJECT

1. Configurar **.env** development , ademas de las variables de la DB:
```
    SANCTUM_STATEFUL_DOMAINS=localhost       
    Aquí se debe establecer el dominio o host donde está desplegado el frontend, incluyendo el puerto.
    En este caso, como se trata de localhost, se deja tal cual.
    En modo desarrollo, por defecto sería localhost:4200.

    SESSION_DOMAIN=localhost
    Esta variable es igual de importante que SANCTUM_STATEFUL_DOMAINS.
    Define el dominio donde se almacenarán las cookies de sesión y, por lo tanto, determina si la comunicación será con localhost o, en su defecto, con 127.0.0.1:8000.

    SESSION_LIFETIME=5

    DB_CONNECTION=mysql
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
```
2. ```bash docker compose up --build``` (opcional)
3. ```bash php artisan migrate:fresh --seed```
4. ```bash php artisan serv```

#### Despues de crear el Proyecto 
Use una imagen de MariaDB porque es un sistema de gestión de bases de datos relacionales (SGBDR) de código abierto, creado por los desarrolladores originales de MySQL, que ofrece una alternativa gratuita y robusta para almacenar, organizar y acceder a datos.

Añadi Adminer que es una herramienta ligera y gratuita de gestión de bases de datos 

Con estas imagenes cree el contendor en Docker exponiendo los puertos 3306 correpondiente asi como el puerto 8081 , talmente configurable en el archivo 
docker-compose.yml 


Despues de un analisis del recurso en cuestion de la prueba tecnica...
realice la normalizacion esté quedando de la siguiente manera (mostrado en la carpeta public) :
1FN Y 2FN:
```
categoria {
	id,
	nombre
}
```
```
marca {
	id
	logo,
	nombre,
	promo,
	imagen
}
```

3FN:
ahora analizando la logica que se solicita la relacion  es de muchos a muchos , 
(una Categoria puede tener muchas Marcas y una Marca puede tener muchas categorias)
Para resolver esta relación, se creó la tabla intermedia:

```
brand_categories {
	brand_id,
	category_id
}
```

YA TENIENDO CLARO LOS DATOS DE QUE HIRIAN EN LA BASE DATOS  (TABLAS Y ATRIBUTOS) me dispuse a crear los 
recursos necesarios modelo , controlador y opcionalmente pero nesesario es (migracion , seeder y factory)
esto para tener una informacion que consultar 

siguendo el siguiente proceso
(--migration --seed --controller --resource --factory --all)

```bash
php artisan make:model Category -mscrf
```
```bash
php artisan make:model Brand -mscrf
```
```bash
php artisan make:model BrandCategory -m
```
despues de añadir los campos en las migraciones , añadir factory y los seeders correpondientes  modifque el archivo DatabaseSeeder.php para isntaciar los seeder que previamnete se ceraron en orden ya solo queda ejecutar 
```bash
php artisan migrate:fresh --seed
```

### ACCIONES REALIZADAS PARA CONFIGURAR SACTUM

De acuerdo a la documentacion de laravel y demanera resumida explicare lo que realice

#### 1.- Instalar

```bash
php artisan install:api
```
#### 2.- Configuracion
  

 - Añadir al modelo **User.php**

```use Laravel\Sanctum\HasApiTokens; ```


Habilitar statefulApi para autenticarse mediante las cookies de sesión de Laravel, a la vez que permite que las solicitudes de terceros o aplicaciones móviles se autentiquen mediante tokens de API **bootstrap/app.php**
```
->withMiddleware(function (Middleware $middleware): void {
	$middleware->statefulApi();
})
```

*Aqui tambien añdi:*

 1. Redireccionamiento por la ruta "/login" , inexistente en mi backend , usualmente deberia de ser una vista

```
$middleware->redirectGuestsTo(function  () {
	return null;
});
```

 2. Excepcion en caso de que no este auntenticado 
```
$exceptions->render(function  (AuthenticationException  $e, $request) {
	return  response()->json([
		'message'  =>  'Unauthenticated'
		], 401);
});
```

#### 3.- Cors

posteriormente para no tener errores de cors se tiene a publicar el archivo cors para habilitar los puntos de interfcambio de informacion

```bash
php artisan config:publish cors
```

Despues se modificó el archivo **cors.php** para permitir el envío de credenciales en solicitudes CORS, habilitando el encabezado Access-Control-Allow-Credentials con el valor true.
Esto se logra configurando la opción `'supports_credentials'=true`

  

ademas de añdir las opciones withCredentials y withXSRFToken en la intancia global de axios modifacndo el archivo **bootstrap.js**

```
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
```
#### 5.- Tiempo de expiracion
 Se modifica el archivo **sanctum.php** la propiedad 
```'expiration' => 5,```

y tambien se podria el **session.php** la propiedad directamente 
```
'lifetime' => (int) env('SESSION_LIFETIME', 120), 
```
o en su defecto  cambiar la variable SESSION_LIFETIME del .env asi :
 ```
SESSION_LIFETIME=5 
```
