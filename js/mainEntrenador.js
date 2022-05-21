//Código para Datables

//$('#example').DataTable(); //Para inicializar datatables de la manera más simple

$(document).ready(function() {    
    let table = $('#example').DataTable({
    //para cambiar el lenguaje a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando resultados",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            }
    }); 
    let equipo = document.getElementById("equipo");
    let jugadores = $("#jugadores");
    equipo.onchange = function(e) {
      let id_equipo = e.target.value
      $.ajax({
        type: "POST",
        url: "ajaxAdministrarJugador.php",
        data: {
          id_equipo: id_equipo
        },
        success: function(response) {
          jugadores.html(response)
        }
      });
    }
    $.ajax({
      type: "POST",
      url: "ajaxAdministrarJugador.php",
      data: {
        id_equipo: equipo.value
      },
      success: function(response) {
        jugadores.html(response)
      }
    });    
});