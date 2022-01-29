<script>
$(document).ready(() => {

  var closeBtn = $('.close-btn');

  var closeModal = function() {
    $('.modal').css('display', 'none');
  };

  closeBtn.click(function() {
    closeModal();
    $('.cart-message').removeClass('alert');
    
  });

});
</script>
