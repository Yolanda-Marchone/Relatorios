

    $(document).ready(function() {
        $('#estados').change(function() {
          var estadoselecionado = $(this).val();
          if (estadoselecionado === '3') {
            $('#inputOculto').show();
          } else {
            $('#inputOculto').hide();
          }
        });
      });
