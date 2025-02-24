# DraftGeniousIQ2 API

La API de DraftGeniousIQ2 actúa como un intermediario entre la aplicación [DraftGeniousIQ2_APP](https://github.com/guti10x/DraftGeniousIQ2_APP.git) y la [Base de Datos](https://github.com/guti10x/DraftGeniousIQ2_APP/tree/main/bd) de la misma, permitiendo la consulta y gestión de datos de manera eficiente. Este repositorio contiene la implementación de la API, proporcionando endpoints para acceder y manipular los recursos necesarios para el funcionamiento de la aplicación.

Con esta API, puedes realizar operaciones como obtener información sobre equipos, jugadores, estadísticas de equipos y jugadores o predicciones de puntos y valores de mercado de los estos, asi como realizar operaciones de actualización, eliminación e inserción de estos mismos. Además permite administrar usuarios y notificaciones del sitio de forma óptima.

## Desarrolados con:
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200" alt="Laravel Logo">

## Pasos de Instalación

0. Asegúrate de tener PHP y Composer instalados en tu sistema.

1. Abre tu terminal o línea de comandos.

2. Descarga el repositorio del proyecto ejecutando el siguiente comando:

    ```bash
    git clone https://github.com/guti10x/DraftGeniousIQ2_API.git
    ```

3. Navega al directorio del proyecto:

    ```bash
    cd DraftGeniousIQ2_API
    ```

4. Instala las dependencias de Composer:

    ```bash
    composer install
    ```

5. Crear y configurar el archivo de entorno:

    - En la raíz del proyecto, encontrarás un archivo llamado `environment.txt`. Este archivo contiene una lista de las variables de entorno necesarias para el proyecto.
    - Abre el archivo `environment.txt` en un editor de texto y rellénalo con tus propias configuraciones. A continuación, se muestra un ejemplo de cómo debería verse el archivo:

        ##### Configuración de la base de datos
        ```plaintext
        DB_HOST=tu_host_de_base_de_datos
        DB_USER=tu_usuario_de_base_de_datos
        DB_PASSWORD=tu_contraseña_de_base_de_datos
        DB_NAME=nombre_de_tu_base_de_datos
        ```

        ##### Configuración del servidor
        ```plaintext
        SERVER_PORT=puerto_del_servidor
        ```

        ##### Otras configuraciones
        ```plaintext
        API_KEY=tu_clave_de_api
        ```

6. Ejecuta las migraciones de la base de datos para crear las tablas necesarias:

    ```bash
    php artisan migrate
    ```

## Ejecución de la API

Después de haber seguido los pasos anteriores, la API debería estar configurado y listo para ejecutarse. Utiliza el siguiente comando para iniciar el servidor:

```bash
php artisan serve
```

## Endpoints de la API:

### - DATOS DE EQUIPOS:
- `GET /equipos`: Obtener todos los equipos.
- `GET /equipos/{equipo}`: Obtener el nombre de un equipo por su ID.
- `GET /equipos/id/{nombre}`: Obtener el ID de un equipo por su nombre.
- `GET /equipos/logo/{id}`: Obtener el logo de un equipo por su ID.
- `POST /equipos`: Crear un nuevo equipo.
- `DELETE /equipos/{id}`: Eliminar un equipo.
- `PUT /equipos/{equipos}`: Actualizar un equipo.

### ESTADÍSTICAS DE LOS EQUIPOS:
- `GET /estadisticas-equipos`: Obtener todas las estadísticas de todos los equipos.
- `GET /estadisticas-equipos/{id}/stats`: Obtener todas las estadísticas asociadas a un ID de un equipo.
- `GET /estadisticas-equipos/{id}/last-stats`: Obtener la última estadística asociada a un ID de un equipo.
- `GET /equipos/{idEquipo}/money`: Devuelve el dinero disponible de un equipo en su cartera.
- `GET /equipos/{equipo}/estadisticas`: Obtener todas las estadísticas asociadas a un equipo por su ID.
- `GET /equipos/{equipo}/estadisticas/last-stats`: Obtener la última estadística asociada a un equipo por su ID.
- `POST /estadisticas-equipos`: Crear una nueva estadística asociada a un equipo.
- `PUT /estadisticas-equipos/{id}`: Actualizar el valor de todas las estadísticas de un equipo.
- `PUT /estadisticas-equipos/{id}/id-equipo`: Actualizar el ID de equipo asociado a una estadística de un equipo.
- `PUT /estadisticas-equipos/{id}/puntos`: Actualizar los puntos obtenidos en una jornada de un equipo.
- `PUT /estadisticas-equipos/{id}/media-puntos-jornada`: Actualizar la media de puntos de un equipo.
- `PUT /estadisticas-equipos/{id}/valor`: Actualizar el valor de un equipo.
- `PUT /estadisticas-equipos/{id}/num-jugadores`: Actualizar el número de jugadores de un equipo.
- `DELETE /estadisticas-equipos/{id_equipo}/all`: Eliminar todas las estadísticas asociadas a un equipo por su ID.

# DATOS DE JUGADORES:
- `GET /jugadores`: Obtener todas las estadísticas globales de un jugador.
- `GET /jugadores/transferidos`: Obtener todos los jugadores transferidos en el mercado.
- `GET /jugadores/{id}/nombre-posicion-equipo`: Obtener el nombre, posición y equipo de un jugador por su ID.
- `GET /jugadores/{nombre}`: Obtener el equipo al que pertenece un jugador pasando su nombre.
- `GET /jugadores/transferibles/{trasfervalue}`: Obtener todos los jugadores transferibles (1) / no transferibles (0).
- `GET /jugadores/recomendados/{trasfervalue}`: Obtener todos los jugadores recomendados (1) / no recomendados (0) por la IA.
- `GET /jugadores/{id}/edad-altura-peso`: Buscar un jugador por su ID y devolver su edad, altura y peso.
- `GET /equipos/{id_equipo}/jugadores`: Obtener todos los jugadores que pertenecen a un equipo por su ID de equipo asociado.
- `GET /jugadores/por-posiciones/{posicion}`: Obtener todos los jugadores que juegan en la misma posición.
- `GET /equipos/{idEquipo}/jugadores/{posicion}`: Obtener todos los jugadores titulares que juegan en una misma posición de un equipo.
- `GET /jugadores/por-equipo/{equipo}`: Obtener todos los jugadores que pertenecen al mismo equipo de LaLiga.
- `POST /jugadores`: Añadir un nuevo jugador a la tabla de jugadores con sus estadísticas globales asociadas.
- `PUT /jugadores/{jugadores}`: Actualizar el conjunto de atributos globales asociados a un jugador.
- `PUT /jugadores/{jugador}/id_jugador`: Actualizar el ID del equipo asociado a un jugador.
- `PUT /jugadores/{jugador}/nombre`: Actualizar el nombre de un jugador.
- `PUT /jugadores/{jugador}/posicion`: Actualizar la posición de un jugador.
- `PUT /jugadores/{jugador}/equipo`: Actualizar el equipo de un jugador.
- `PUT /jugadores/{jugador}/edad`: Actualizar la edad de un jugador.
- `PUT /jugadores/{jugador}/altura`: Actualizar la altura de un jugador.
- `PUT /jugadores/{jugador}/peso`: Actualizar el peso de un jugador.
- `DELETE /jugadores/{id}`: Eliminar un jugador por su ID.

## ESTADÍSTICAS DE LOS JUGADORES:
*De la última jornada disputada por el jugador.
- `GET /estadisticas-jornadas`: Obtener todas las estadísticas asociadas a todos los jugadores.
- `GET /estadisticas-jornadas/{id}/estadisticas`: Obtener todas las últimas estadísticas (las más recientes) asociadas al ID de un jugador que no son nulas.
- `POST /estadisticas-jornadas`: Añadir a la tabla estadisticas_jugadores una nueva estadística asociada a un jugador y jornada.

## USUARIOS:
- `GET /usuarios`: Obtener todos los usuarios y datos asociados almacenados en la base de datos.
- `GET /usuarios/{id}`: Devolver datos de un usuario buscado en la base de datos por su ID.
- `GET /usuarios/email/{email}`: Devolver datos de un usuario buscado en la base de datos por su email.
- `GET /usuarios/email/{email}`: Obtener el id de un usuario pasándolo como parámetro su email.
- `GET /usuarios/email_verified/{email}`: Obtener la comprobación de que un email ha sido verificado.
- `GET /usuarios/rol/1`: Obtener todos los usuarios con rol 1 (admin).
- `GET /usuarios/rol/0`: Obtener todos los usuarios con rol 0 (user app).
- `GET //user/role`: Obtener el correo electrónico asociado a un email de un usuario.
- `POST /usuarios`: Registrar un nuevo usuario en la base de datos.
- `POST /auth/login`: Devolver token JWT pasándole como parámetro el email y contraseña.
- `PUT /usuarios/{id}/actualizar-nombre`: Actualizar el nombre del usuario.
- `PUT /usuarios/{id}/actualizar-email`: Actualizar el correo electrónico del usuario.
- `PUT /usuarios/{id}/actualizar-password`: Actualizar la contraseña del usuario.
- `PUT /usuarios/{id}/actualizar-id-equipo`: Actualizar el ID del equipo del usuario.
- `PUT /usuarios/{id}/actualizar-rol`: Actualizar el rol del usuario.
- `DELETE /usuarios/{id}`: Eliminar un usuario por su ID.

## NOTIFICACIONES:
- `GET /notificaciones`: Devolver todas las notificaciones almacenadas en la base de datos.
- `GET /notificaciones/{id_ntf}`: Obtener notificación por su ID.
- `GET /notificaciones/user/{id_user}`: Obtener todas las notificaciones de un usuario por su ID.
- `GET /notificaciones/type/{type}`: Obtener todas las notificaciones de un tipo específico.
- `POST /notificaciones`: Almacenar una nueva notificación en la base de datos.
- `PUT /notificaciones/{id_ntf}/updateUserId`: Actualizar el ID de usuario asociado a una notificación.
- `PUT /notificaciones/{id_ntf}/updateTitle`: Actualizar el título de una notificación.
- `PUT /notificaciones/{id_ntf}/updateContent`: Actualizar el contenido de una notificación.
- `PUT /notificaciones/{id_ntf}/updateType`: Actualizar el tipo de una notificación.
- `DELETE /notificaciones/{id}`: Eliminar una notificación por su ID.
- `DELETE /notificaciones/user/{id_user}`: Eliminar todas las notificaciones de un usuario por su ID.
- `DELETE /notificaciones/type/{type}`: Eliminar todas las notificaciones de un tipo específico.

## PREDICCIONES DE PUNTOS
- `GET /pred_puntos`: Obtener todas las predicciones de puntos almacenadas en la base de datos.
- `GET /pred_puntos/player/{id_player}`: Obtener todas las predicciones de puntos asociadas a un jugador por su ID.
- `GET /pred_puntos/player/{id_player}/last`: Obtener la última predicción de puntos asociada a un jugador por su ID.
- `POST /pred_puntos`: Almacenar una nueva predicción de puntos asociada a un jugador.
- `PUT /pred_puntos/{id_prediccion}/update_player`: Modificar el ID de jugador asociado a una predicción de puntos por su ID.
- `PUT /pred_puntos/{id_prediccion}/update_value`: Modificar el valor de una predicción de puntos por su ID.
- `DELETE /pred_puntos/{id_prediccion}`: Eliminar una predicción de puntos por su ID.
- `DELETE /pred_puntos/player/{id_player}/last`: Eliminar la última predicción de puntos asociada a un jugador por su ID.
- `DELETE /pred_puntos/player/{id_player}`: Eliminar todas las predicciones de puntos asociadas a un jugador por su ID.

## PREDICCIONES VALOR DE MERCADO
- `GET /pred_valor`: Obtener todas las predicciones de valor de mercado almacenadas en la base de datos.
- `GET /pred_valor/player/{id_player}`: Obtener todas las predicciones de valor de mercado asociadas a un jugador por su ID.
- `GET /pred_valor/player/{id_player}/last`: Obtener la última predicción de valor de mercado asociada a un jugador por su ID.
- `GET /pred_puntos/top3`: Devuelve las 3 predicciones de puntos con el valor más alto.
- `POST /pred_valor`: Almacenar una nueva predicción de valor de mercado asociada a un jugador.
- `PUT /pred_valor/{id_prediccion}/update_player`: Modificar el ID de jugador asociado a una predicción de valor de mercado por su ID.
- `PUT /pred_valor/{id_prediccion}/update_value`: Modificar el valor de una predicción de valor de mercado por su ID.
- `DELETE /pred_valor/{id_prediccion}`: Eliminar una predicción de valor de mercado por su ID.
- `DELETE /pred_valor/player/{id_player}/last`: Eliminar la última predicción de valor de mercado asociada a un jugador por su ID.
- `DELETE /pred_valor/player/{id_player}`: Eliminar todas las predicciones de valor de mercado asociadas a un jugador por su ID.

## Partidos de la Liga
- `GET /partidos`: Devolver todos los partidos registrados en la base de datos.
- `GET /partidos/last-jornada-matches`: Obtener todos los partidos de la última jornada registrada en la base de datos.
- `GET /partidos/recent-match`: Devuelve el último partido disputado, priorizando el más reciente en caso de empate en la fecha de actualización, se selecciona el partido con el máximo número de goles.

## Novedades/Actualizaciones de la Aplicación
- `GET /novedades-recientes`: Devuelve las 3 novedades más recientes.

## Valoraciones de la Aplicación
- `GET /valoraciones-recientes`: Devuelve las 3 valoraciones más recientes.
- `POST /valoraciones`: Crea una nueva valoración.