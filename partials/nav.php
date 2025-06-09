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
                    <li class="nav-item"><a href="index.php?action=paciente_create" class="nav-link text-white">Crear</a></li>
                    <li class="nav-item"><a href="index.php?action=paciente_index" class="nav-link text-white">Ver todos</a></li>
                </ul>
            </li>

            <!-- ENFERMERA -->
            <li class="nav-item has-children">
                <span class="toggle-btn">+</span> Enfermera
                <ul class="nested">
                    <li class="nav-item"><a href="index.php?action=enfermera_create" class="nav-link text-white">Crear</a></li>
                    <li class="nav-item"><a href="index.php?action=enfermera_index" class="nav-link text-white">Ver todas</a></li>
                </ul>
            </li>

            <!-- CITAS -->
            <li class="nav-item has-children">
                <a href="index.php?action=cita_index" class="nav-link text-white">Citas</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?action=logout">Cerrar sesión</a>
            </li>
        </ul>
    </div>
    