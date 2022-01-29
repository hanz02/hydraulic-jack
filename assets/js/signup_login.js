$(document).ready(() => {

  // FORM VALIDATION
  var checkForm = function(items) {

    items.each(function() {

      if($(this).val() == '') {
        $('.form-body .alert').addClass('active');
        $('.form-body .alert.active').text("Please don't leave the fields empty");
        return check_result = false;

      } else if($(this).attr('type') == 'email' && $(this).val().indexOf('@') == -1) {
          $('.alert').addClass('active');
          $('.alert.active').text("Invalid Email");
          return check_result = false;

      } else if($(this).attr('type') == 'email' && $(this).val().substr($(this).val().length - 1) == '@') {
          $('.alert').addClass('active');
          $('.alert.active').text("Invalid Email");
          return check_result = false;

      } else {
        return check_result = true;
      }

    });

    return check_result;
  };

  // DROP DOWN SHOWS
  $('.default-option').click(function() {
    $(this).parent().toggleClass('active');
  });

  // DROP DOWN MENU CLOSE ON CLICKING OPTIONS
  $('.alt-option li').click(function() {

    const currentOpt = $(this).html();
    $('.default-option li').html(currentOpt);
    $('.default-option li input').attr("name", "gender_selected");
    $('.default-option').parent().toggleClass('active');
  });

  // FORM VALIDATION CONTINUE BTN SIGN UP
  $('#continue-btn').click(function() {
    if(checkForm($('.step-1 input')) == true) {
      $('.alert').removeClass('active');
      $('.alert').text("");
      $('.step-1').toggleClass('active');
      $('.step-2').toggleClass('active');
    }
  });

  $('.signup-btn').click(function(e) {
    $('.alert').removeClass('active');

    if(checkForm($('.step-2 input')) !== true) {
      e.preventDefault();

    } else if($('.password-field').val() !== $('.cpw-field').val()) {
      $('.alert').addClass('active');
      $('.alert.active').text("Please confirm you password again");
      e.preventDefault();

    } else if ($('.password-field').val() == $('.cpw-field').val() && checkForm($('.step-2 input')) == true) {
      $('.alert.active').text("");
      $('.alert').removeClass('active');
    }
  });

  $('.login-btn').click(function(e) {
    $('.form-body .alert').removeClass('active');

    if(checkForm($('.login-form input')) == false) {
      e.preventDefault();
    }
  });
});
