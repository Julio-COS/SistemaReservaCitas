<?php include('./partials/head.php'); ?>
<body>
<!-- <div> incluido en el nav-->
    <?php include('./partials/nav.php'); ?>


    <!-- Main content -->
    <div id="content" class="flex-grow-1 p-3">
        <span id="sidebarToggle" class="btn btn-secondary mb-3">&#9776; Menú</span>

        <div class="container">

            <h2>Editar Enfermera</h2>
            <form action="index.php?action=enfermera_update&id=<?= $enfermera['id_enfermera'] ?>" method="POST">
                <label>Nombre:</label><br>
                <input type="text" name="nombre" value="<?= $enfermera['nombre'] ?>" required><br>

                <label>Apellido Paterno:</label><br>
                <input type="text" name="apellido_p" value="<?= $enfermera['apellido_p'] ?>" required><br>

                <label>Apellido Materno:</label><br>
                <input type="text" name="apellido_m" value="<?= $enfermera['apellido_m'] ?>" required><br>

                <label>DNI:</label><br>
                <input type="text" name="dni" value="<?= $enfermera['dni'] ?>" required><br>

                <label>Especialidad:</label><br>
                <input type="text" name="especialidad" value="<?= $enfermera['especialidad'] ?>" required><br>

                <label>Teléfono:</label><br>
                <input type="text" name="telefono" value="<?= $enfermera['telefono'] ?>"><br>

                <label>Email:</label><br>
                <input type="email" name="email" value="<?= $enfermera['email'] ?>"><br>

                <br>
                <button type="submit">Actualizar</button>
            </form>



        </div>
    </div>


</div>
</body>
<script src="./assets/js/sidebar.js"></script>
</html>