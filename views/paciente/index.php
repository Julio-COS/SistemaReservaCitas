<?php include('./partials/head.php'); ?>
<body>
<!-- <div> incluido en el nav-->
    <?php include('./partials/nav.php'); ?>


    <!-- Main content -->
    <div id="content" class="flex-grow-1 p-3">
        <span id="sidebarToggle" class="btn btn-secondary mb-3">&#9776; Menú</span>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3" >
                <h3>Listado Paciente</h3>
                <div class="d-flex justify-content-center content-hover">
                    <a href="index.php?action=paciente_create" class="btn btn-primary font-weight-bold">+</a>
                </div>                        
            </div>
            <table border="1" class="table">
                
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre completo</th>
                        <th>DNI</th>
                        <th>Fecha de nacimiento</th>
                        <th>Sexo</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                     <?php foreach ($pacientes['data'] as $paciente): ?>
                        <tr>
                            <td><?= $paciente['id_paciente'] ?></td>
                            <td><?= $paciente['nombre'] . ' ' . $paciente['apellido_p'] . ' ' . $paciente['apellido_m'] ?></td>
                            <td><?= $paciente['dni'] ?></td>
                            <td><?= $paciente['fecha_nacimiento'] ?></td>
                            <td><?= $paciente['sexo'] ?></td>
                            <td><?= $paciente['telefono'] ?></td>
                            <td><?= $paciente['email'] ?></td>
                            <td><?= $paciente['direccion'] ?></td>
                            <td>
                                <a href="index.php?action=paciente_update&id=<?= $paciente['id_paciente'] ?>">Editar</a>
                                |
                                <a href="index.php?action=paciente_delete&id=<?= $paciente['id_paciente'] ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                                <a href="index.php?action=historia_view&id=<?= $paciente['id_paciente'] ?>">Ver Historia Clínica</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Paginación -->
            <?php if ($pacientes['total'] > $limit): ?>
                <nav>
                    <ul class="pagination">
                        <?php
                            $totalPaginas = ceil($pacientes['total'] / $limit);
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