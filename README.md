# Paso 1: Crear una aplicación en el portal de desarrolladores de LinkedIn
1. Accede al portal de desarrolladores de LinkedIn.
2. Crea una nueva aplicación.
3. Proporciona la información necesaria, como el nombre de la aplicación, la descripción, la URL de redireccionamiento, etc.
4. Una vez creada la aplicación, obtén las claves de API (Client ID y Client Secret).

# Paso 2: Instalar el paquete Socialite
Socialite es un paquete de Laravel que facilita la autenticación con servicios de terceros, incluido LinkedIn. Instálalo mediante Composer:
```bash
composer require laravel/socialite
```

# Paso 3: Configurar las credenciales de LinkedIn
Añade las credenciales de LinkedIn en el archivo .env de tu proyecto Laravel:
```
LINKEDIN_CLIENT_ID=774p0ywiiaq7ii
LINKEDIN_CLIENT_SECRET=3zqR2IDK97HHkIpl
LINKEDIN_REDIRECT_URI=https://www.linkedin.com/company/51728668/admin/feed/posts/?feedType=following
```

# Paso 4: Configurar Socialite
Añade las siguientes configuraciones en config/services.php:
```php
'linkedin' => [
    'client_id' => env('LINKEDIN_CLIENT_ID'),
    'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
    'redirect' => env('LINKEDIN_REDIRECT_URI'),
],
```
