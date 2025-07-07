<?php include('./partials/head.php'); ?>
<body>
<!-- <div> incluido en el nav-->
    <?php include('./partials/nav.php'); ?>


    <!-- Main content -->
    <div id="content" class="flex-grow-1 p-3">
        <span id="sidebarToggle" class="btn btn-secondary mb-3">&#9776; Menú</span>
        <div class="container">

            <?php if (!empty($bonificaciones)): ?>
                <div class="alert alert-info">
                    <h5>🎉 Bonificaciones activas hoy</h5>
                    <ul>
                        <?php foreach ($bonificaciones as $bon): ?>
                            <li>
                                El paciente <strong><?= $bon['nombre'].' '.$bon['apellido_p'].' '.$bon['apellido_m']  ?></strong> tiene una cita gratuita válida solo por hoy.
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        
        </div>
    </div>

</div>
</body>
<script src="./assets/js/sidebar.js"></script>
</html>