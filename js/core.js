
$(document).ready(function() {
  var myCarousel = document.querySelector('#carouselExampleControls');
  var carousel = new bootstrap.Carousel(myCarousel, {
    interval: 10000,
    pause: false,
    touch:false
  });
});

(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    var button = document.getElementById("form_button");
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      button.addEventListener('click', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        } else {
          jQuery.ajax({
          	url: ajax_var.url,
     		type: 'post',
     		data: {
         		action: 'core',
         		nonce: ajax_var.nonce,   // pass the nonce here
         		name: $("#name").val(),
         		email: $("#email").val(),
         		company: $("#company").val(),
         		designation: $("#designation").val()
     		},
            success:function(data){
               $("#status").css("display","block");
               $("#form_name").css("display","none");
               $("#form_email").css("display","none");
               $("#form_company").css("display","none");
               $("#form_designation").css("display","none");
               $("#form_consent").css("display","none");
               $("#form_button").css("display","none");
               $("#form_header").css("display","none");
            },
            error:function (){}
          });
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();