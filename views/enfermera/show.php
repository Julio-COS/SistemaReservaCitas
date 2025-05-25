
<?php include('./partials/head.php'); ?>
<body>
<!-- <div> incluido en el nav-->
    <?php include('./partials/nav.php'); ?>


    <!-- Main content -->
    <div id="content" class="flex-grow-1 p-3">
        <span id="sidebarToggle" class="btn btn-secondary mb-3">&#9776; Menú</span>

        <div class="container">
            <h2>Información de la Enfermera</h2>
            <p><strong>ID:</strong> <?= $enfermera['id_enfermera'] ?></p>
            <p><strong>Nombre completo:</strong> <?= $enfermera['nombre'] . ' ' . $enfermera['apellido_p'] . ' ' . $enfermera['apellido_m'] ?></p>
            <p><strong>DNI:</strong> <?= $enfermera['dni'] ?></p>
            <p><strong>Especialidad:</strong> <?= $enfermera['especialidad'] ?></p>
            <p><strong>Teléfono:</strong> <?= $enfermera['telefono'] ?></p>
            <p><strong>Email:</strong> <?= $enfermera['email'] ?></p>

            <a href="index.php?action=enfermera_index">← Volver al listado</a>


        </div>
    </div>


</div>
</body>
<script src="./assets/js/sidebar.js"></script>
</html>