<?php include('./partials/head.php'); ?>
<body>
<!-- <div> incluido en el nav-->
    <?php include('./partials/nav.php'); ?>


    <!-- Main content -->
    <div id="content" class="flex-grow-1 p-3">
        <span id="sidebarToggle" class="btn btn-secondary mb-3">&#9776; Menú</span>
        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-3" >
                <h2>Listado de Enfermeras</h2>
                <div class="d-flex justify-content-center content-hover">
                    <a href="index.php?action=enfermera_create" class="btn btn-primary font-weight-bold">+</a>
                </div>                        
            </div>

            <table border="1" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre completo</th>
                        <th>DNI</th>
                        <th>Especialidad</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                     <?php foreach ($enfermeras['data'] as $enfermera): ?>
                        <tr>
                            <td><?= $enfermera['id_enfermera'] ?></td>
                            <td><?= $enfermera['nombre'] . ' ' . $enfermera['apellido_p'] . ' ' . $enfermera['apellido_m'] ?></td>
                            <td><?= $enfermera['dni'] ?></td>
                            <td><?= $enfermera['especialidad'] ?></td>
                            <td><?= $enfermera['telefono'] ?></td>
                            <td><?= $enfermera['email'] ?></td>
                            <td>
                                <a href="index.php?action=enfermera_update&id=<?= $enfermera['id_enfermera'] ?>">Editar</a> |
                                <a href="index.php?action=enfermera_delete&id=<?= $enfermera['id_enfermera'] ?>" onclick="return confirm('¿Estás seguro de eliminar?')">Eliminar</a> |
                                <a href="index.php?action=enfermera_show&id=<?= $enfermera['id_enfermera'] ?>">Ver</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <!-- Paginación -->
            <?php if ($enfermeras['total'] > $limit): ?>
                <nav>
                    <ul class="pagination">
                        <?php
                            $totalPaginas = ceil($enfermeras['total'] / $limit);
                            for ($i = 1; $i <= $totalPaginas; $i++): ?>
                            <li class="page-item <?php echo ($pagina == $i) ? 'active' : ''; ?>">
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="pagina" value="<?php echo $i; ?>">
                                    <button type="submit" class="page-link"><?php echo $i; ?></button>
                                </form>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>

</div>
</body>
<script src="./assets/js/sidebar.js"></script>
</html>