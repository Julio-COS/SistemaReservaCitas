
<?php include('./partials/head.php'); ?>
<body>
<?php include('./partials/nav.php'); ?>

<div id="content" class="flex-grow-1 p-3">
    <span id="sidebarToggle" class="btn btn-secondary mb-3">&#9776; Menú</span>
    <div class="container">
        <div id="calendar"></div>

        <!-- Modal para agendar/editar cita -->
        <div class="modal fade" id="modalCita" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formCita" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Cita</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="fecha" name="fecha">
                            <input type="hidden" id="hora" name="hora">
                            <input type="hidden" id="hora_fin" name="hora_fin">

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
                            <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'timeGridWeek',
      selectable: true,
      editable: true,
      events: 'index.php?action=cita_get_all',

      select: function(info) {
        $('#fecha').val(info.startStr.split("T")[0]);
        $('#hora').val(info.startStr.split("T")[1].substring(0,5));
        $('#hora_fin').val(info.endStr.split("T")[1].substring(0,5));
        $('#formCita').removeAttr('data-id');
        $('#formCita')[0].reset();
        $('#modalCita').modal('show');
      },

      eventClick: function(info) {
        const cita = info.event.extendedProps;
        $('#fecha').val(info.event.startStr.split("T")[0]);
        $('#hora').val(info.event.startStr.split("T")[1].substring(0,5));
        $('#hora_fin').val(info.event.endStr.split("T")[1].substring(0,5));
        $('input[name="id_paciente"]').val(cita.id_paciente);
        $('input[name="id_enfermera"]').val(cita.id_enfermera);
        $('textarea[name="motivo"]').val(cita.motivo);
        $('#formCita').attr('data-id', info.event.id);
        $('#modalCita').modal('show');
      },

      eventDrop: function(info) {
        actualizarCita(info.event);
      },

      eventResize: function(info) {
        actualizarCita(info.event);
      }
    });
    calendar.render();

    function actualizarCita(evento) {
      
      $.post('index.php?action=cita_update&id=' + evento.id, {
        fecha: evento.startStr.split("T")[0],
        hora: evento.startStr.split("T")[1].substring(0,5),
        hora_fin: evento.endStr.split("T")[1].substring(0,5)
      }, function(response) {
        calendar.refetchEvents();
      });
    }

    $('#formCita').submit(function(e) {
      e.preventDefault();
      const id = $(this).attr('data-id');
      const url = id ? 'index.php?action=cita_update&id=' + id : 'index.php?action=cita_create';

      $.post(url, $(this).serialize(), function(response) {
        $('#modalCita').modal('hide');
        calendar.refetchEvents();
      });
    });

    $('#btnEliminar').click(function () {
      const id = $('#formCita').attr('data-id');
      if (id && confirm('¿Estás seguro de eliminar esta cita?')) {
        $.post('index.php?action=cita_delete&id=' + id, function(response) {
          $('#modalCita').modal('hide');
          calendar.refetchEvents();
        });
      }
    });
  });
</script>
</body>
