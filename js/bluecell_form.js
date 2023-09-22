(function ($, Drupal) {
    Drupal.behaviors.bluecellForm = {
      attach: function (context, settings) {
        $("#bluecell-form", context).once('bluecellForm').each(function () {
          $(this).submit(function (event) {
            var isValid = true;
            var errorMsg = '';
            // Validación de nombre
            var nombreVal = $('#edit-nombre').val();
            if (!nombreVal || nombreVal.length <= 2) {
              isValid = false;
              errorMsg += 'El campo nombre es obligatorio y debe tener más de 2 caracteres.\n';
            }
            // Validación de email
            var emailVal = $('#edit-email').val();
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!emailVal) {
              isValid = false;
              errorMsg += 'El campo email es obligatorio.\n';
            } else if (!emailRegex.test(emailVal)) {
              isValid = false;
              errorMsg += 'Introduce una dirección de correo válida.\n';
            }
            // Validación de teléfono
            var telVal = $('#edit-telefono').val();
            var telRegex = /^[0-9]+$/;
            if (!telVal) {
              isValid = false;
              errorMsg += 'El campo teléfono es obligatorio.\n';
            } else if (!telRegex.test(telVal)) {
              isValid = false;
              errorMsg += 'El teléfono solo debe contener números.\n';
            }
            // Validación de mensaje
            var mensajeVal = $('#edit-mensaje').val();
            if (!mensajeVal || mensajeVal.length <= 50) {
              isValid = false;
              errorMsg += 'El campo mensaje es obligatorio y debe tener más de 50 caracteres.\n';
            }
            // Validación de asunto
            var asuntoVal = $('#edit-asunto').val();
            if (!asuntoVal || asuntoVal.length <= 6) {
              isValid = false;
              errorMsg += 'El campo asunto es obligatorio y debe tener más de 6 caracteres.\n';
            }
            // Validación de aceptación
            if (!$('#edit-aceptacion').is(':checked')) {
              isValid = false;
              errorMsg += 'Debes aceptar las políticas.\n';
            }
            if (!isValid) {
              alert(errorMsg);
              event.preventDefault();
              return;
            }
            // Lógica AJAX para enviar el formulario (se completará en el próximo paso)
          });
        });
      }
    };
  })(jQuery, Drupal);