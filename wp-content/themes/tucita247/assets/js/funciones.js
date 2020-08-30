
$( document ).ready(function() {

  $('#planes').on('change', function() {
    $('.card-paquetes').hide();
    $('#p'+this.value).show();
  });

  function formatPaisesCiudades (item) {
    if (!item.id) { return item.text; }
    var $item = $(
      '<span>'+item.text+"</span>"
    );
    return $item;
  };


  $('.AutoSelectPaises').select2({
    placeholder: ph_select,
    theme: 'bootstrap4',
    templateResult: formatPaisesCiudades,
    data: paises,
    language: {
      noResults: function (params) {
        return sin_resultados;
      }
    }
  });

  $.get( "https://api.tucita247.com/locations/cities/PRI/"+language, function( data ) {
    var ciudades = [];
    for(var k in data) {
      var ciudad = {id:data[k]['CityId'],text:data[k]['Name']};
      ciudades.push(ciudad);
    }

    $('.AutoSelectCiudades').select2({
      placeholder: ph_select,
      theme: 'bootstrap4',
      templateResult: formatPaisesCiudades,
      data: ciudades,
      language: {
        noResults: function (params) {
          return sin_resultados;
        }
      }
    });
  });

});

function reEnvioCorreo(){
  var email = $("#correoAdministrador").val();
  $('#codigoValidacion').removeClass('is-valid');
  $('#codigoValidacion').removeClass('is-invalid');
  $("#codigoValidacion").val('');
  verificacionOk = false;
  $.get( "https://api.tucita247.com/business/validemail/"+email, function( data ) {
    verificationCode = data.VerificationCode;
    alert("Código de verificación enviado nuevamente.");
  });
}

function checkAvailibility(slug){
  $.get( "https://api.tucita247.com/business/tucitalink/"+slug, function( data ) {

    if(data.Available){
      $('#spinner-tucitalink').hide();
      $('#slugNegocio').addClass('is-valid');
      $('#slugNegocioEstado').val(true);
    }else{
      $('#spinner-tucitalink').hide();
      $('#slugNegocio').addClass('is-invalid');
    }
  });
}

function checkEmailCode(){
  $('#codigoValidacion').removeClass('is-valid');
  $('#codigoValidacion').removeClass('is-invalid');
  if(verificationCode===md5($("#codigoValidacion").val())){
    $('#codigoValidacion').addClass('is-valid');
    verificacionOk = true;
  }else{
    $('#codigoValidacion').addClass('is-invalid');
    verificacionOk = false;
  }
}