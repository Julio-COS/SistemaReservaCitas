<?php include('./partials/head.php'); ?>
<body>
<!-- <div> incluido en el nav-->
    <?php include('./partials/nav.php'); ?>


    <!-- Main content -->
    <div id="content" class="flex-grow-1 p-3">
        <span id="sidebarToggle" class="btn btn-secondary mb-3">&#9776; Menú</span>

        <div class="container">

            <h2>Actualizar Paciente</h2>
            <form action="index.php?action=paciente_update&id=<?= $paciente['id_paciente'] ?>" method="POST">
                <label>Nombre:</label><br>
                <input type="text" name="nombre" value="<?= $paciente['nombre'] ?>" class="form-control" required><br>

                <label>Apellido Paterno:</label><br>
                <input type="text" name="apellido_p" value="<?= $paciente['apellido_p'] ?>" class="form-control" required><br>

                <label>Apellido Materno:</label><br>
                <input type="text" name="apellido_m" value="<?= $paciente['apellido_m'] ?>" class="form-control" required><br>

                <label>DNI:</label><br>
                <input type="text" name="dni" value="<?= $paciente['dni'] ?>" class="form-control" required><br>

                <label>Fecha de Nacimiento:</label><br>
                <input type="date" name="fecha_nacimiento" value="<?= $paciente['fecha_nacimiento'] ?>" class="form-control" required><br>

                <label>Sexo:</label><br>
                <select name="sexo" class="form-control" required>
                    <option value="M" <?= $paciente['sexo'] == 'M' ? 'selected' : '' ?>>Masculino</option>
                    <option value="F" <?= $paciente['sexo'] == 'F' ? 'selected' : '' ?>>Femenino</option>
                </select><br>

                <label>Teléfono:</label><br>
                <input type="text" name="telefono" value="<?= $paciente['telefono'] ?>" class="form-control" required><br>

                <label>Email:</label><br>
                <input type="email" name="email" value="<?= $paciente['email'] ?>" class="form-control" required><br>

                <label>Dirección:</label><br>
                <input type="text" name="direccion" value="<?= $paciente['direccion'] ?>" class="form-control" required><br>

                <br>
                <button type="submit" class="btn btn-primary" >Actualizar</button>
                <a href="?action=paciente_index" class="btn btn-secondary" style="right: 0;">Regresar</a>
            </form>

        </div>
    </div>


</div>
</body>
<script src="./assets/js/sidebar.js"></script>
</html>