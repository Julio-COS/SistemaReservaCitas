<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: index.php?action=login");
    exit;
}
?>

<div class="d-flex">
    <!-- Sidebar -->
    <div id="sidebar" class="bg-dark text-white p-3" style="width: 250px;">
        <h4 class="mb-4">Bienvenido <?php echo $_SESSION['username']; ?></h4>
        <ul class="nav flex-column tree-menu">
            <!-- PACIENTE -->
            <li class="nav-item has-children">
                <span class="toggle-btn">+</span> Paciente
                <ul class="nested">
                    <li class="nav-item"><a href="index.php?action=crear_paciente" class="nav-link text-white">Crear</a></li>
                    <li class="nav-item"><a href="index.php?action=listar_pacientes" class="nav-link text-white">Ver todos</a></li>
                    <li class="nav-item"><a href="index.php?action=editar_paciente" class="nav-link text-white">Editar</a></li>
                    <li class="nav-item"><a href="index.php?action=eliminar_paciente" class="nav-link text-white">Eliminar</a></li>
                </ul>
            </li>

            <!-- ENFERMERA -->
            <li class="nav-item has-children">
                <span class="toggle-btn">+</span> Enfermera
                <ul class="nested">
                    <li class="nav-item"><a href="index.php?action=crear_enfermera" class="nav-link text-white">Crear</a></li>
                    <li class="nav-item"><a href="index.php?action=listar_enfermeras" class="nav-link text-white">Ver todas</a></li>
                    <li class="nav-item"><a href="index.php?action=editar_enfermera" class="nav-link text-white">Editar</a></li>
                    <li class="nav-item"><a href="index.php?action=eliminar_enfermera" class="nav-link text-white">Eliminar</a></li>
                </ul>
            </li>

            <!-- HISTORIA CLÍNICA -->
            <li class="nav-item has-children">
                <span class="toggle-btn">+</span> Historia Clínica
                <ul class="nested">
                    <li class="nav-item"><a href="index.php?action=crear_historia" class="nav-link text-white">Crear</a></li>
                    <li class="nav-item"><a href="index.php?action=listar_historias" class="nav-link text-white">Ver todas</a></li>
                    <li class="nav-item"><a href="index.php?action=editar_historia" class="nav-link text-white">Editar</a></li>
                    <li class="nav-item"><a href="index.php?action=eliminar_historia" class="nav-link text-white">Eliminar</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?action=logout">Cerrar sesión</a>
            </li>
        </ul>
    </div>
    

