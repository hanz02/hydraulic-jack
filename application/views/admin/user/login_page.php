<?php $this->load->view('include/header') ?>
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/login_style.css ">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin_style/login_signup_style.css ">

  <script src="<?php echo base_url() ?>assets/js/signup_login.js"></script>

</head>
<body>
  <main class="login_bg flex admin_login">
      <?php echo form_open('admin/admin_control/login_submit', array(
          "method" => "post",
          "class" => "login-form f-middle p-y4"
      )); ?>

          <h3 class="f-w-heavy f-sm-2 f-ls-3">Login</h3>
          <div class="form-body p-1">
            <div class="alert f-sm-ex"></div>

            <div class="form-group m-y2">
              <label class="f-sm" for="email">Email: </label>
              <input type="email" name="email" class="email-field" value="<?php echo set_value('email') ?>">

              <div class="error-db f-sm-ex">
                <?php
                if($this->session->flashdata('error_login_email') != "") {
                    echo $this->session->flashdata('error_login_email');
                  }
                 ?>
              </div>
            </div>

            <div class="form-group m-y2">
              <label class="f-sm" for="email">Password: </label>
              <input type="password" name="password" class="password-field">

              <div class="error-db f-sm-ex">
                <?php
                if($this->session->flashdata('error_login_pw') != "") {
                    echo $this->session->flashdata('error_login_pw');
                  }
                 ?>
              </div>
            </div>
            <button class="f-ls-2 login-btn" type="submit" name="button" value="sign-in">Sign In</button>
        </div>

      <?php echo form_close(); ?>
  </main>
</body>
</html>