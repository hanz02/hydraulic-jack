<?php $this->load->view('include/header') ?>
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/signup_style.css ">
  <script src="<?php echo base_url() ?>assets/js/signup_login.js"></script>
</head>
<body>
  <main class="signup_bg flex">
      <?php echo form_open('user_control/signup_submit', array(
          "method" => "post",
          "class" => "signup-form f-middle p-y1"
      )); ?>

          <div class="form-body p-1 step-1 active">
            <h3 class="f-w-heavy f-sm-2 f-ls-3">Sign Up</h3>
            <div class="form-fields">
              <div class="alert f-sm-ex"></div>
              <div class="form-group">
                <label class="f-sm" for="email">First Name: </label>
                <input type="text" name="f-name" class="fname-field" required>
              </div>
              <div class="form-group">
                <label class="f-sm" for="email">Last Name: </label>
                <input type="text" name="l-name" class="lname-field" required>
              </div>
              <div class="form-group email-group">
                <label class="f-sm" for="email">Email: </label>
                <input type="email" name="email" class="email-field" required>
                <?php if($this->session->flashdata('error_email') != "") { ?>
                  <div class="f-sm-ex error-db"><?php echo $this->session->flashdata('error_email'); ?></div>
                <?php } ?>
              </div>
              <div class="form-group">
                <label class="f-sm" for="gender">Gender: </label>
                <div class="option-menu">
                  <ul class="default-option">
                    <li>
                      <p>Male
                        <input class="gender_selected" type="hidden" name="gender_selected" value="male">
                      </p>
                    </li>
                  </ul>
                  <ul class="alt-option">
                    <li>
                      <p>Male
                        <input class="gender_option" type="hidden" name="gender_option" value="male">
                      </p>
                    </li>
                    <li>
                      <p>Female
                        <input class="gender_option" type="hidden" name="gender_option" value="female">
                      </p>
                    </li>
                    <li>
                      <p>Prefer not to say
                        <input class="gender_option" type="hidden" name="gender_option" value="prefer not to say">
                      </p>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="form-group">
                <label class="f-sm" for="email">Date Of Birth: </label>
                <input type="date" name="birthday" class="dob-field" required>
              </div>
            </div>

            <div class="form-group issue-link">
              <a class="f-sm-ex" href="<?php echo site_url('login') ?>">Already have an account?</a>
            </div>
            <button class="m-y2 f-ls-2" id="continue-btn" type="button" name="continue">Continue</button>
          </div>

          <div class="form-body p-1 step-2">
            <h3 class="f-w-heavy f-sm-2 f-ls-3">Sign Up</h3>

            <div class="form-fields">
              <div class="alert f-sm-ex"></div>
              <div class="form-group">
                <label class="f-sm" for="email">User Name: </label>
                <input type="text" name="u-name" class="uname-field" required>
              </div>
              <div class="form-group">
                <label class="f-sm" for="password">Passsword: </label>
                <input type="password" name="password" class="password-field" required>
              </div>
              <div class="form-group email-group">
                <label class="f-sm" for="c-password">Confirm Password: </label>
                <input type="password" name="c-password" class="cpw-field" required>
              </div>
            </div>
            <div class="form-group issue-link">
              <a class="f-sm-ex" href="<?php echo site_url('login') ?>">Already have an account?</a>
            </div>
            <button class="m-y2 f-ls-2 signup-btn" type="submit" name="signup">Sign Up</button>
          </div>
      <?php echo form_close(); ?>
  </main>
</body>
</html>
