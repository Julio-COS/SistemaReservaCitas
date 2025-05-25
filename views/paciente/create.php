
<?php include('./partials/head.php'); ?>
<body>
<!-- <div> incluido en el nav-->
    <?php include('./partials/nav.php'); ?>


    <!-- Main content -->
    <div id="content" class="flex-grow-1 p-3">
        <span id="sidebarToggle" class="btn btn-secondary mb-3">&#9776; Menú</span>

        <div class="container">
            <h2>Registrar Paciente</h2>
            <form action="index.php?action=paciente_create" method="POST">
                <label>Nombre:</label><br>
                <input type="text" name="nombre" class="form-control" required><br>

                <label>Apellido Paterno:</label><br>
                <input type="text" name="apellido_p" class="form-control" required><br>

                <label>Apellido Materno:</label><br>
                <input type="text" name="apellido_m" class="form-control" required><br>

                <label>DNI:</label><br>
                <input type="text" name="dni" class="form-control" required><br>

                <label>Fecha de Nacimiento:</label><br>
                <input type="date" name="fecha_nacimiento" class="form-control" required><br>

                <label>Sexo:</label><br>
                <select name="sexo" class="form-control" required>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select><br>

                <label>Teléfono:</label><br>
                <input type="text" name="telefono" class="form-control" required><br>

                <label>Email:</label><br>
                <input type="email" name="email" class="form-control" required><br>

                <label>Dirección:</label><br>
                <input type="text" name="direccion" class="form-control" required><br>

                <br>
                <button type="submit">Guardar</button>
            </form>

        </div>
    </div>


</div>
</body>
<script src="./assets/js/sidebar.js"></script>
</html>