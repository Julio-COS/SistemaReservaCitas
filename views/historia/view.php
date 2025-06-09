<?php include('./partials/head.php'); ?>
<body>
<!-- <div> incluido en el nav-->
    <?php include('./partials/nav.php'); ?>


    <!-- Main content -->
    <div id="content" class="flex-grow-1 p-3">
        <span id="sidebarToggle" class="btn btn-secondary mb-3">&#9776; Menú</span>
        <h3>Historia Clínica</h3>

        <?php if ($historia): ?>
        <form method="POST" action="index.php?action=historia_update">
            <input type="hidden" name="id_historia" value="<?= $historia['id_historia'] ?>">
            <input type="hidden" name="id_paciente" value="<?= $historia['id_paciente'] ?>">

            <div class="mb-3">
                <label>Descripción:</label>
                <textarea name="descripcion" class="form-control"><?= $historia['descripcion'] ?></textarea>
            </div>
            <div class="mb-3">
                <label>Diagnóstico:</label>
                <textarea name="diagnostico" class="form-control"><?= $historia['diagnostico'] ?></textarea>
            </div>
            <div class="mb-3">
                <label>Tratamiento:</label>
                <textarea name="tratamiento" class="form-control"><?= $historia['tratamiento'] ?></textarea>
            </div>
            <div class="mb-3">
                <label>Observaciones:</label>
                <textarea name="observaciones" class="form-control"><?= $historia['observaciones'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Historia Clínica</button>
        </form>
        <?php else: ?>
            <p>No hay historia clínica registrada para este paciente.</p>
        <?php endif; ?>

    </div>

</div>
</body>
<script src="./assets/js/sidebar.js"></script>
</html>