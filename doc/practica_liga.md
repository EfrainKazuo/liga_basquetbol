# Práctica Calificada: Gestión de Liga de Básquetbol

Documentación técnica dirigida al equipo de desarrollo.

## 1. Arquitectura del sistema

Aplicación web monolítica construida con Laravel (PHP) bajo el patrón MVC, con MySQL como base de datos y Git/GitHub para el control de versiones. Cada petición entra por `routes/web.php`, que la dirige a un controlador; este consulta los modelos Eloquent y devuelve una vista Blade. Las vistas heredan de `layouts/app.blade.php` y usan Bootstrap 5 por CDN junto con una hoja de estilos propia (`public/css/liga.css`).

Las rutas se dividen en dos grupos de middleware: `guest` (login y registro) y `auth` (equipos, jugadores, partidos y estadísticas). Ningún módulo es accesible sin sesión iniciada.

## 2. Clases implementadas

- **Modelos:** `User`, `Equipo`, `Jugador`, `Partido`.
- **Controladores:** `AuthController`, `EquipoController`, `JugadorController`, `PartidoController`, `EstadisticaController`.
- **Migraciones:** `users`, `equipos`, `jugadores`, `partidos`.
- **Seeder:** `DatabaseSeeder`, que carga un usuario de prueba, cuatro equipos, veinte jugadores y ocho partidos.

Relaciones: un `Equipo` tiene muchos `Jugador` (`hasMany`). Un `Partido` pertenece a dos equipos, local y visitante, por lo que `Equipo` expone `partidosLocal()` y `partidosVisitante()`.

## 3. Funcionalidades desarrolladas

- **Autenticación:** registro, inicio y cierre de sesión con `Auth` y sesiones; la sesión se regenera al ingresar.
- **Equipos:** CRUD con nombre único y contador de jugadores.
- **Jugadores:** se administran dentro del detalle de cada equipo; el número de camiseta no se repite dentro del mismo equipo.
- **Partidos:** registro de partidos programados y finalizados con marcador; se rechazan los empates y los partidos de un equipo contra sí mismo.
- **Estadísticas:** tabla de posiciones y dashboard con líder, mejor ataque, últimos resultados y próximos partidos.

## 4. Fragmentos relevantes de código

Validación del número de camiseta, acotada al equipo:

```php
Rule::unique('jugadores', 'numero_camiseta')
    ->where('equipo_id', $equipo->id)
    ->ignore($jugador?->id)
```

`where` limita la unicidad al equipo y `ignore` evita que el jugador choque consigo mismo al editarse.

La tabla de posiciones suma, por equipo, los partidos finalizados como local y como visitante (victoria = 2 puntos, derrota = 1) y se ordena comparando arreglos:

```php
return [$b->pts, $b->dif, $b->pf] <=> [$a->pts, $a->dif, $a->pf];
```

Desempata por puntos, diferencia de puntos y puntos a favor.

En `Partido`, cada relación indica su llave foránea:

```php
return $this->belongsTo(Equipo::class, 'equipo_local_id');
```

## 5. Problemas encontrados y soluciones

1. **Pluralización:** Laravel generó la tabla `jugadors`. Se nombró `jugadores` en la migración y se agregó `protected $table` al modelo.
2. **Parámetro de ruta:** en las rutas anidadas el parámetro se llamaba `jugadore`; se corrigió con `->parameters(['jugadores' => 'jugador'])`.
3. **Dos llaves foráneas a la misma tabla:** `Partido` necesitó indicar la columna en cada `belongsTo`.
4. **Rutas en el grupo equivocado:** el recurso `equipos` quedó en el grupo `guest`, lo que redirigía al usuario autenticado y le impedía crear equipos y jugadores. Se movió al grupo `auth`.
5. **Conflicto de merge:** `create.blade.php` se creó en dos ramas (conflicto `add/add`). Se resolvió manualmente conservando una sola versión.

## 6. Decisiones técnicas y justificación

- **Autenticación manual en lugar de Breeze:** da control total del flujo y evita depender de Node y Vite.
- **Posiciones calculadas al vuelo:** no se guardan en la base, por lo que nunca quedan desactualizadas al editar o eliminar un partido.
- **Puntos `nullable` y campo `estado`:** un mismo registro sirve para partidos programados y finalizados; si el estado es programado se descartan los puntos.
- **Formulario parcial `_form`:** crear y editar lo comparten, lo que evita duplicar código.
- **Rutas anidadas con `shallow()`:** crear un jugador depende del equipo, pero editar y eliminar usan `/jugadores/{jugador}`.
- **Bootstrap por CDN con CSS propio y tema oscuro:** interfaz sobria sin paso de compilación.
- **Ramas por funcionalidad y Pull Requests:** cada módulo se integró a `main`, dejando un historial progresivo.
- **Seeder idempotente:** usa `firstOrCreate` y solo crea partidos si la tabla está vacía, por lo que puede ejecutarse varias veces.
