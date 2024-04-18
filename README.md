# DraftGeniousIQ2 API

La API de DraftGeniousIQ2 actúa como un intermediario entre la aplicación [DraftGeniousIQ2_APP](https://github.com/guti10x/DraftGeniousIQ2_APP.git) y la [Base de Datos](https://github.com/guti10x/DraftGeniousIQ2_APP/tree/main/bd) de la misma, permitiendo la consulta y gestión de datos de manera eficiente. Este repositorio contiene la implementación de la API, proporcionando endpoints para acceder y manipular los recursos necesarios para el funcionamiento de la aplicación.

Con esta API, puedes realizar operaciones como obtener información sobre equipos, jugadores, estadísticas de equipos y jugadores o predicciones de puntos y valores de mercado de los estos, asi como realizar operaciones de actualización, eliminación e inserción de estos mismos. Además permite administrar usuarios y notificaciones del sitio de forma óptima.

## Desarrolados con:
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200" alt="Laravel Logo">

# Endpoints de la API:
## - DATOS DE EQUIPOS:
- `GET /equipos`: Obtener todos los equipos.
- `GET /equipos/{equipo}`: Obtener el nombre de un equipo por su ID.
- `GET /equipos/id/{nombre}`: Obtener el ID de un equipo por su nombre.
- `POST /equipos`: Crear un nuevo equipo.
- `DELETE /equipos/{id}`: Eliminar un equipo.
- `PUT /equipos/{equipos}`: Actualizar un equipo.

## - ESTADÍSTICAS DE EQUIPOS:
- `GET /estadisticas-equipos`: Obtener todas las estadísticas de todos los equipos.
- `GET /estadisticas-equipos/{id}/stats`: Obtener todas las estadísticas de un equipo por su ID.
- `GET /estadisticas-equipos/{id}/last-stats`: Obtener la última estadística de un equipo por su ID.
- `POST /estadisticas-equipos`: Crear una nueva estadística para un equipo.
- `PUT /estadisticas-equipos/{id}`: Actualizar todas las estadísticas de un equipo.
- `PUT /estadisticas-equipos/{id}/id-equipo`: Actualizar el ID de un equipo asociado a una estadística.
- `PUT /estadisticas-equipos/{id}/puntos`: Actualizar los puntos de un equipo en una jornada.
- `PUT /estadisticas-equipos/{id}/media-puntos-jornada`: Actualizar la media de puntos de un equipo.
- `PUT /estadisticas-equipos/{id}/valor`: Actualizar el valor de un equipo.
- `PUT /estadisticas-equipos/{id}/num-jugadores`: Actualizar el número de jugadores de un equipo.
- `DELETE /estadisticas-equipos/{id_equipo}/all`: Eliminar todas las estadísticas de un equipo.
- `GET /equipos/{equipo}/estadisticas`: Obtener todas las estadísticas de un equipo por su ID.
- `GET /equipos/{equipo}/estadisticas/last-stats`: Obtener la última estadística de un equipo por su ID.
- `GET /equipos/{idEquipo}/money`: Devuelve el dinero que tiene disponible un equipo en su cartera.

## - DATOS DE JUGADORES:
- `GET /jugadores`: Obtener todas las estadísticas globales de un jugador.
- `GET /jugadores/{id}/nombre-posicion-equipo`: Obtener nombre, posición y equipo de un jugador por su ID.
- `GET /jugadores/{nombre}`: Obtener equipo al que pertenece un jugador pasando su nombre.
- `GET /jugadores/transferibles/{trasfervalue}`: Obtener todos los jugadores transferibles (trasfervalue=1) o no transferibles (trasfervalue=0).
- `GET /jugadores/{id}/edad-altura-peso`: Obtener edad, altura y peso de un jugador por su ID.
- `GET /equipos/{id_equipo}/jugadores`: Obtener jugadores por ID de equipo.
- `GET /jugadores/por-posiciones/{posicion}`: Obtener jugadores por posición.
- `GET /equipos/{idEquipo}/jugadores/{posicion}`: Obtener todos los jugadores titulares que juegan en una misma posición de un equipo.
- `GET /jugadores/por-equipo/{equipo}`: Obtener jugadores por equipo.
- `POST /jugadores`: Añadir un nuevo jugador con sus estadísticas globales.
- `PUT /jugadores/{jugadores}`: Actualizar atributos globales de un jugador.
- `PUT /jugadores/{jugador}/id_jugador`: Actualizar ID de equipo asociado a un jugador.
- `PUT /jugadores/{jugador}/nombre`: Actualizar nombre de un jugador.
- `PUT /jugadores/{jugador}/posicion`: Actualizar posición de un jugador.
- `PUT /jugadores/{jugador}/equipo`: Actualizar equipo de un jugador.
- `PUT /jugadores/{jugador}/edad`: Actualizar edad de un jugador.
- `PUT /jugadores/{jugador}/altura`: Actualizar altura de un jugador.
- `PUT /jugadores/{jugador}/peso`: Actualizar peso de un jugador.
- `DELETE /jugadores/{id}`: Eliminar un jugador por su ID.

## - ESTADÍSTICAS DE JUGADORES:
- `GET /estadisticas-jornadas`: Obtener todas las estadísticas de todos los jugadores.
- `GET /estadisticas-jornadas/{id}/estadisticas`: Obtener últimas estadísticas de un jugador por su ID.
- `POST /estadisticas-jornadas`: Añadir una nueva estadística para un jugador en una jornada.

## - DATOS DE USUARIOS:
- `GET /usuarios`: Obtener todos los usuarios y sus datos almacenados en la base de datos.
- `POST /usuarios`: Registrar un nuevo usuario en la base de datos.
- `GET /usuarios/{id}`: Obtener datos de un usuario buscado por su ID.
- `GET /usuarios/nombre/{name}`: Obtener datos de un usuario buscado por su nombre.
- `GET /usuarios/rol/1`: Obtener todos los usuarios con rol 1 (admin).
- `GET /usuarios/rol/0`: Obtener todos los usuarios con rol 0 (user app).
- `PUT /usuarios/{id}/actualizar-nombre`: Actualizar el nombre de un usuario.
- `PUT /usuarios/{id}/actualizar-email`: Actualizar el correo electrónico de un usuario.
- `PUT /usuarios/{id}/actualizar-password`: Actualizar la contraseña de un usuario.
- `PUT /usuarios/{id}/actualizar-id-equipo`: Actualizar el ID del equipo del usuario.
- `PUT /usuarios/{id}/actualizar-rol`: Actualizar el rol del usuario.
- `DELETE /usuarios/{id}`: Eliminar un usuario por su ID.

## - DATOS DE NOTIFICACIONES
- `GET /notificaciones`: Devolver todas las notificaciones almacenadas en la base de datos.
- `GET /notificaciones/{id_ntf}`: Obtener una notificación por su ID.
- `GET /notificaciones/user/{id_user}`: Obtener todas las notificaciones de un usuario por su ID.
- `GET /notificaciones/type/{type}`: Obtener todas las notificaciones de un tipo específico.
- `POST /notificaciones`: Almacenar una nueva notificación en la base de datos.
- `PUT /notificaciones/{id_ntf}/updateUserId`: Actualizar el ID de usuario de una notificación.
- `PUT /notificaciones/{id_ntf}/updateTitle`: Actualizar el título de una notificación.
- `PUT /notificaciones/{id_ntf}/updateContent`: Actualizar el contenido de una notificación.
- `PUT /notificaciones/{id_ntf}/updateType`: Actualizar el tipo de una notificación.
- `DELETE /notificaciones/{id}`: Eliminar una notificación por su ID.
- `DELETE /notificaciones/user/{id_user}`: Eliminar notificaciones de un usuario por su ID.
- `DELETE /notificaciones/type/{type}`: Eliminar notificaciones por tipo.

## - PREDICCIONES DE PUNTOS DE JUGADORES:
- `GET /pred_puntos`: Obtener todas las predicciones de puntos almacenadas en la base de datos.
- `GET /pred_puntos/player/{id_player}`: Obtener todas las predicciones de puntos asociadas a un jugador.
- `GET /pred_puntos/player/{id_player}/last`: Obtener la última predicción de puntos asociada a un jugador.
- `POST /pred_puntos`: Almacenar una nueva predicción de puntos asociada a un jugador.
- `PUT /pred_puntos/{id_prediccion}/update_player`: Modificar el jugador asociado a una predicción de puntos.
- `PUT /pred_puntos/{id_prediccion}/update_value`: Modificar el valor de una predicción de puntos.
- `DELETE /pred_puntos/{id_prediccion}`: Eliminar una predicción de puntos por su ID.
- `DELETE /pred_puntos/player/{id_player}/last`: Eliminar la última predicción de puntos asociada a un jugador.
- `DELETE /pred_puntos/player/{id_player}`: Eliminar todas las predicciones de puntos asociadas a un jugador.

## - PREDICCIONES VALOR DE MERCADO DE JUGADORES:
- `GET /pred_valor`: Obtener todas las predicciones de valor de mercado almacenadas en la base de datos.
- `GET /pred_valor/player/{id_player}`: Obtener todas las predicciones de valor de mercado asociadas a un jugador.
- `GET /pred_valor/player/{id_player}/last`: Obtener la última predicción de valor de mercado asociada a un jugador.
- `POST /pred_valor`: Almacenar una nueva predicción de valor de mercado asociada a un jugador.
- `PUT /pred_valor/{id_prediccion}/update_player`: Modificar el jugador asociado a una predicción de valor de mercado por su ID.
- `PUT /pred_valor/{id_prediccion}/update_value`: Modificar el valor de una predicción de valor de mercado por su ID.
- `DELETE /pred_valor/{id_prediccion}`: Eliminar una predicción de valor de mercado por su ID.
- `DELETE /pred_valor/player/{id_player}/last`: Eliminar la última predicción de valor de mercado asociada a un jugador.
- `DELETE /pred_valor/player/{id_player}`: Eliminar todas las predicciones de valor de mercado asociadas a un jugador.
