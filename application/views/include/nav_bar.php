<header class='nav'>

  <nav class='container grid'>
    <div class="logo">
      <a href="<?php echo site_url('home') ?>"><h1 class="f-w-heavy f-ls-3">HYDRAULIC JACK</h1></a>
    </div>
    <div class="flex cart-profile">
      <div class="profile m-x-sm flex">
        <?php
          if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1") {
        ?>
        <?php
          if($this->session->has_userdata('profile_img_state') == true && $this->session->userdata('profile_img_state') == 1) {
        ?> 
            <div class="profile-btn f-sm-ex f-ls-1">
              <img src="<?php echo base_url('assets/img/profile_img/') . $this->session->userdata('login_profile_img') ?>" alt="profile img">
            </div>
        <?php
            } else {
        ?>
            <div class="profile-btn f-sm-ex f-ls-1 default">
              <img src="<?php echo base_url().$this->session->userdata('login_profile_img') ?>" alt="profile default img">
            </div>
        <?php
            }
        ?>  
            <span class="username">
              <?php echo $this->session->userdata('username') ?>
            </span>
            <div class="profile-menu">
              <ul class=" f-middle">
                <li class="p-y1 f-sm-ex"><a href="<?php echo site_url('profile') ?>">VIEW PROIFLE</a></li>
                <li class="p-y1 f-sm-ex"><a href="<?php echo site_url('user_control/logout') ?>">LOGOUT</a></li>
              </ul>
            </div>
        <?php
          } else if ($this->session->userdata('login') == "0" || $this->session->has_userdata('login') == false) {
        ?>
            <a href="<?php echo site_url('login') ?>" class= "login-btn f-sm-ex f-ls-1 f-w-heavy">LOGIN</a>
        <?php
          }
        ?>
      </div>
      <a class="cart-btn" href="<?php echo site_url('cart') ?>"><i class="f-sm-1 fas fa-shopping-cart"></i></a>
    </div>
    <div class="hamburger flex">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <ul class="menu f-middle f-sm-ex">
      <li><a href="<?php echo site_url('home') ?>">HOME</a></li>
      <!-- <li><a href="#">COMMISSIONS</a></li> -->
      <li><a href="<?php echo site_url('products') ?>">PRODUCTS</a></li>
      <li><a href="<?php echo site_url('about_jack') ?>">ARTISTS</a></li>
    </ul>
  </nav>
</header>
