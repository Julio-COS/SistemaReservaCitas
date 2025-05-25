<?php include('./partials/head.php'); ?>

<body>
    <div class="position-fixed d-flex top-0 start-0 bottom-0 end-0 align-items-center w-100 vh-100 bg-light">
        <div class="border rounded p-3 mx-auto bg-white" style="width: 400px">
            <form action="index.php?action=login" method="post">
                <h2 class="mb-4 text-center">Iniciar Sesión</h2>

                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="d-flex form-control align-items-center">
                        <input type="password" class="border-0 w-100" style="outline: none;" id="password" name="password" required>
                        <span id="togglePassword" class="ml-2" style="cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Ingresar</button>

            </form>

            <!-- Nuevo botón para registrarse -->

            <div class="register-link d-none">
                <p>¿No tienes una cuenta?</p>
                <a href="?action=show_register" class="btn btn-secondary w-100">Registrarse</a>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./assets/js/showpass.js"></script>
</body>

</html>