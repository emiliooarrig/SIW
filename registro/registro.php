<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registro.css">
    <title>Registro de Usuario</title>
</head>

<body>

    <form action="register.php" method="POST" class="formulario">
        <h2>Registro de Usuario</h2>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="input-form" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="input-form" required>

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" class="input-form" required>

        <label>Rol</label>
        <div class="radio-group">
            <input type="radio" name="rol" value="Usuario" id="usuario" required>
            <label for="usuario">Usuario</label>

            <input type="radio" name="rol" value="Técnico" id="tecnico">
            <label for="tecnico">Técnico</label>

            <input type="radio" name="rol" value="Administrador" id="admin">
            <label for="admin">Administrador</label>
        </div>

        <button type="submit" class="btn">Registrar</button>
    </form>

</body>

</html>
