<?php include('./partials/head.php'); ?>
<body>
<!-- <div> incluido en el nav-->
    <?php include('./partials/nav.php'); ?>


    <!-- Main content -->
    <div id="content" class="flex-grow-1 p-3">
        <span id="sidebarToggle" class="btn btn-secondary mb-3">&#9776; Menú</span>

        <div class="container">
            <div id="calendar"></div>

    <!-- Modal para agendar cita -->
    <div class="modal fade" id="modalCita" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <form id="formCita" method="POST">
            <div class="modal-header">
            <h5 class="modal-title">Agendar Cita</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            <input type="hidden" id="fecha" name="fecha">
            <input type="hidden" id="hora" name="hora">
            <div class="mb-3">
                <label>Paciente ID:</label>
                <input type="number" name="id_paciente" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Enfermera ID:</label>
                <input type="number" name="id_enfermera" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Motivo:</label>
                <textarea name="motivo" class="form-control"></textarea>
            </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
        </div>
    </div>
    </div>


        </div>
    </div>

</div>
</body>
<script src="./assets/js/sidebar.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'timeGridWeek',
      allDaySlot: false,
      selectable: true,
      select: function (info) {
        $('#fecha').val(info.startStr.split("T")[0]);
        $('#hora').val(info.startStr.split("T")[1].substring(0, 5));
        $('#modalCita').modal('show');
      },
      events: 'index.php?action=cita_get_all'
    });

    calendar.render();

    $('#formCita').on('submit', function (e) {
      e.preventDefault();

      $.ajax({
        url: 'index.php?action=cita_create',
        type: 'POST',
        data: $(this).serialize(),
        success: function (response) {
          $('#modalCita').modal('hide');
          calendar.refetchEvents(); // Recargar eventos en el calendario
        }
      });
    });
  });
</script>
</html>