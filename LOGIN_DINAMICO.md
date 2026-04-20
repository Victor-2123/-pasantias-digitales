# Login Dinámico - Guía de Instalación

## Cambios Realizados

Se ha implementado un sistema de **login dinámico con selección de tipo de usuario** (Estudiante/Maestro). Los siguientes cambios se han realizado:

### 1. **Migración de Base de Datos**
- **Archivo**: `database/migrations/0004_01_01_000000_add_user_type_to_users_table.php`
- **Cambio**: Se agregó el campo `user_type` a la tabla `users` con un ENUM que puede ser `'estudiante'` o `'maestro'`
- **Valor por defecto**: `'estudiante'`

### 2. **Modelo User**
- **Archivo**: `app/Models/User.php`
- **Cambio**: Se agregó `'user_type'` al array `$fillable` para permitir asignación masiva

### 3. **Controlador de Registro**
- **Archivo**: `app/Http/Controllers/Auth/RegisteredUserController.php`
- **Cambios**:
  - Validación del campo `user_type` (requiere ser 'estudiante' o 'maestro')
  - Asignación del `user_type` al crear un nuevo usuario

### 4. **Vistas Mejoradas**

#### Vista de Bienvenida (Principal)
- **Archivo**: `resources/views/welcome.blade.php`
- **Cambio**: Página elegante con selector visual de tipo de usuario
- **Características**:
  - Tarjetas interactivas para seleccionar tipo de usuario
  - Diseño moderno con gradiente
  - Opciones para iniciar sesión o registrarse
  - Responsive (funciona en móvil y desktop)

#### Vista de Registro
- **Archivo**: `resources/views/auth/register.blade.php`
- **Cambio**: Se agregó selector de tipo de usuario
- **Características**:
  - Dos opciones con radio buttons estilizados
  - Cambia dinámicamente el color según la selección
  - Validación del lado del cliente y servidor
  - Emojis ilustrativos (👨‍🎓 Estudiante, 👨‍🏫 Maestro)

#### Vista de Login
- **Archivo**: `resources/views/auth/login.blade.php`
- **Cambio**: Se agregó selector visual de tipo de usuario
- **Características**:
  - Botones interactivos para elegir tipo de usuario
  - Proporciona mejor UX al mostrar opciones antes de ingresar credenciales
  - Puramente visual (para referencia del usuario)

## Pasos para Ejecutar

### 1. Ejecutar las Migraciones
```bash
php artisan migrate
```

### 2. (Opcional) Ejecutar Seeders
```bash
php artisan db:seed
```

### 3. Iniciar el Servidor
```bash
php artisan serve
```

### 4. Acceder a la Aplicación
- Ve a `http://localhost:8000`
- Se mostrará la página de bienvenida con el selector de tipo de usuario
- Haz clic en "Registrarse" para crear una nueva cuenta
- Selecciona tu tipo de usuario (Estudiante o Maestro)
- O haz clic en "Iniciar Sesión" si ya tienes cuenta

## Estructura del Flujo

```
Página de Bienvenida (welcome.blade.php)
    ↓
    ├─→ Registrarse → Formulario de Registro con Selector de Tipo
    │                        ↓
    │                   Dashboard (autenticado)
    │
    └─→ Iniciar Sesión → Formulario de Login con Selector de Tipo
                                ↓
                           Dashboard (autenticado)
```

## Base de Datos

### Campo Agregado a la Tabla `users`
```php
$table->enum('user_type', ['estudiante', 'maestro'])
      ->default('estudiante')
      ->after('email');
```

## Características del Sistema

✅ **Selección Visual de Tipo de Usuario**
- Tarjetas interactivas en la página de bienvenida
- Indicadores visuales en registro
- Interfaz intuitiva

✅ **Validación Completa**
- Validación del lado del servidor
- Campo requerido con opciones limitadas

✅ **Diseño Responsivo**
- Funciona perfectamente en móviles
- Adaptable a diferentes tamaños de pantalla

✅ **Emojis Descriptivos**
- 👨‍🎓 para estudiantes
- 👨‍🏫 para maestros

✅ **Gradientes y Animaciones**
- Interfaz moderna y atractiva
- Transiciones suaves

## Próximos Pasos (Opcional)

Para extender la funcionalidad, podrías:

1. **Crear middleware** para redirigir según el tipo de usuario:
   ```php
   // Crear archivo app/Http/Middleware/RedirectByUserType.php
   ```

2. **Agregar roles y permisos** usando Laravel's built-in authorization

3. **Crear vistas específicas** para estudiantes y maestros en el dashboard

4. **Agregar campos adicionales** en la tabla de usuarios (ej: grado, especialidad, etc.)

## Notas Importantes

- El sistema usa Bootstrap/Tailwind para estilos (verifica tu configuración)
- La validación del `user_type` está en el controlador de registro
- Los datos se guardan correctamente en la base de datos
- Puedes acceder al tipo de usuario con: `auth()->user()->user_type`

---

**¡El sistema está listo para usar!** 🚀
