var loadRecaptcha = function() {
  grecaptcha.render('recaptchaInput', {
    'sitekey' : theme_js_params.sitekey,
    'callback' : verifyCaptcha,
  });
};

var verifyCaptcha = function (response) {
  $("#reCaptcha").val(response);
};