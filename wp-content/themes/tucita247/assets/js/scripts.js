$(document).ready(function(){
  AOS.init({ disable: 'mobile' });
});

var paises = [{id:'PRI',text:'PUERTO RICO'}];

// SELECT 2
function formatCategories (item) {
  if (!item.id) { return item.text; }
  var $item = $(
    '<span class="'+ item.class+' item-categoria">'+
    '<span style="background-image:url('+item.icono+');" class="icono-categorias"></span>'+item.text+"</span>"
  );
  return $item;
};

$('.AutoSelectCategorias').select2({
  placeholder: 'Seleccione una opción',
  theme: 'bootstrap4',
  templateResult: formatCategories,
  data: categorias,
  language: {
    noResults: function (params) {
      return sin_resultados;
    }
  }
});

// WIZARD
var verificationCode="";
var verificacionOk=false;
var correoEnviado=false;
$("#wizard-registration").wizard({
  stepsWrapper: "#wrapped",
  submit: ".submit",
  beforeForward: function( event, state ) {



    if( state.stepIndex === 2 ){
      return correoEnviado;
    }

    if( state.stepIndex === 3 ){
      if($("#codigoValidacion").val()!=""){
        $('#codigoValidacion').addClass('is-valid');
      }else{
        $('#codigoValidacion').addClass('is-invalid');
      }
      return verificacionOk;
    }

    if ( state.stepIndex === 4 ) {
      var categoriaSeleccionada = $("#categorias").select2('data');
      $("#categoriaDetalle").val(categoriaSeleccionada[0].text);
      $("#proveedorDeServicioDetalle").val($("#nombreNegocio").val());
    }


    return $( this ).wizard( "form" ).valid();
  }
}).wizard( "form" ).submit(function( event ) {
  event.preventDefault();
  $("#modalLoading").modal('show',{keyboard: false, backdrop:false});
  planSeleccionado=$('#planes').val();
  planSeleccionadoID=$('#planes').find(':selected').data('plan');

  jQuery.ajax({
    type: "post",
    url: ajax_var.url,
    data: "action=add_business&"+ jQuery(this).serialize()  + "&p="+planSeleccionadoID+"&nonce=" + $("#nonce").val(),
    success: function (result) {

      if(result=="0"){
        alert("Error al crear la cuenta [Código: 0]");
      }else{
        if(result=="99"){
          if(window.location.href.indexOf("/es/") > -1){
            window.location.href = 'https://tucita247.com/es/gracias';
          } else {
            window.location.href = 'https://tucita247.com/thankyou';
          }
        }else{
          window.location.href = ajax_var.site_url+'/checkout';
        }
      }

    }
  });


}).validate({
  errorPlacement: function errorPlacement(error, element) { element.before(error); },
  //ignore: [],
  rules: {

  },
  messages: {
    reCaptcha: msg_recaptcha,
    slugNegocioEstado: msg_slug_valido,
    required: msg_required,
    emailDisponible: msg_email_valido,
  }
});

jQuery.extend(jQuery.validator.messages, {
  required: msg_required,
  //remote: "Please fix this field.",
  email: msg_email,
  //url: "Please enter a valid URL.",
  //date: "Please enter a valid date.",
  //dateISO: "Please enter a valid date (ISO).",
  //number: "Please enter a valid number.",
  //digits: "Please enter only digits.",
  //creditcard: "Please enter a valid credit card number.",
  //equalTo: "Please enter the same value again.",
  //accept: "Please enter a value with a valid extension.",
  //maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
  //minlength: jQuery.validator.format("Please enter at least {0} characters."),
  //rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
  //range: jQuery.validator.format("Please enter a value between {0} and {1}."),
  //max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
  min: jQuery.validator.format(msg_min)
});



// reCaptcha
/*
clave sitio web: 6LddgrgZAAAAAGpzUE7sg2lZgMblL7paIf8x08rx
clave secreta: 6LeEgbgZAAAAAPjvrGmCse1X5BNINbtWlOMdCA5m
*/

$('#codigoValidacion').on('change', function() {
  checkEmailCode();
});


// MODAL AYUDA

$('#modalHelp').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var mensaje = button.data('texto');
  var modal = $(this)
  modal.find('.modal-body .modalContenido').html(mensaje)
})


// HIDDEN INPUTS (VALIDATE)

$("#nombreNegocio").on('change', function(){
  var Text = $(this).val();
  Text = Text.toLowerCase();
  Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
  $("#slugNegocio").val(Text);
  $( "#slugNegocio" ).change();
});

$('#slugNegocio').on('change', function() {
  var delayInMilliseconds = 1000;
  $('#spinner-tucitalink').show();
  $('#slugNegocio').removeClass('is-valid');
  $('#slugNegocio').removeClass('is-invalid');
  setTimeout(function() {
    checkAvailibility($('#slugNegocio').val());
  }, delayInMilliseconds);
});

$('#correoAdministrador').on('change', function() {
  $('#correoAdministrador').removeClass('is-valid');
  $('#correoAdministrador').removeClass('is-invalid');

  var delayInMilliseconds = 1000;
  $('#spinner-email').show();
  setTimeout(function() {
    var email = $("#correoAdministrador").val();
    var existeEmail;
    $.get( "https://api.tucita247.com/business/validemail/"+email, function( data ) {
      if(data.Code==200){
        verificationCode = data.VerificationCode;
        if(data.Existe===1){
          $('#correoAdministrador').addClass('is-invalid');
          correoEnviado=false;
        }else{
          $('#correoAdministrador').addClass('is-valid');
          $('#emailDisponible').val(true);
          correoEnviado=true;
        }
      }else{
        verificationCode = '';
        existeEmail=0;
        $('#correoAdministrador').addClass('is-invalid');
        correoEnviado=false;

      }
    });
    $('#spinner-email').hide();
  }, delayInMilliseconds);
});

function phoneMask() {
  var num = $(this).val().replace(/\D/g,'');
  $(this).val(num.substring(0,1) + '(' + num.substring(1,4) + ')' + num.substring(4,7) + '-' + num.substring(7,11));
}
$('[type="tel"]').keyup(phoneMask);