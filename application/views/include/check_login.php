<script>
  var base_url = '<?php echo base_url(); ?>';
  <?php
  // IF USER LOGGED IN
    if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1") {
  ?>
      var user_id = <?php echo $this->session->userdata('login_client_id'); ?>;
  <?php

    } else {  // IF USER NOT LOGGED IN
  ?>
      var user_id = "none";
  <?php
    }
  ?>
</script>
