<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> Inicio de sesion </title>
</head>

<body>

    <form action="login.php" class="formulario" method="post">
        <label for="user"> Usuario </label>
        <input type="text" name="user" id="user" class="input-form">

        <label for="password"> Contraseña </label>
        <input type="password" name="password" id="password" class="input-form">

        <button type="submit" class="btn"> Iniciar sesion </button>
    </form>
</body>

</html>