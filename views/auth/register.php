<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="position-fixed d-flex top-0 start-0 bottom-0 end-0 align-items-center w-100 vh-100 bg-light">
        <div class="border rounded p-3 mx-auto bg-white" style="width: 550px">
            <h2 class="mb-4 text-center">Registro de nuevo usuario</h2>
            <form action="index.php?action=register" class="position-relative" method="post">
                <div class="d-flex justify-content-between">
                    <div class="form-group w-100 px-2">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" required>
                    </div>
                    <div class="form-group w-100 px-2">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-group w-100 px-2">
                        <label for="username">Usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group w-100 px-2">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="form-group px-2">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
                <div class="form-group px-2">
                    <label for="role_id">Rol</label>
                    <select class="form-control w-auto" id="role_id" name="role_id" required>
                        <!-- <option value="1">Admin</option> -->
                        <option value="2">Encargado</option>
                        <option value="3">Doctor</option>
                        <option value="4">Call Center</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between px-2">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="?action=login" class="btn btn-secondary" style="right: 0;">Regresar</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
