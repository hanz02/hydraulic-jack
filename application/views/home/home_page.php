<?php $this->load->view('include/header'); ?>
<link rel="stylesheet" href="<?php base_url() ?>assets/css/KEYFRAME.css">
<link rel="stylesheet" href="<?php base_url() ?>assets/css/index_style.css">

</head>
<body>

  <?php $this->load->view('include/nav_bar'); ?>
  <main class="hero h-vh">
    <div class="container flex home-banner">
      <div class="banner-title">
        <h1 class="f-sm f-w-heavy f-ls-5">HYDRAULIC JACK</h1>
        <hr>
        <h3 class="f-sm f-ls-2">Illustration Workshop</h3>
      </div>
      <div class="banner-body">
        <h4 class="f-sm-ex f-w-light f-ls-2">Artistically Impacting | Visually Outstanding</h4>
        <?php
          if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1") {
        ?>
          <a href="<?php echo site_url('products'); ?>" class="button m-1 f-ls-2">Browse Products</a>
        <?php
          } else if ($this->session->userdata('login') == "0" || $this->session->has_userdata('login') == false) {
        ?>
          <a href="<?php echo site_url('signup'); ?>" class="button m-1 f-ls-2">Sign Up</a>
        <?php
          }
        ?>
      </div>
    </div>
  </main>

  <!-- <section class="upselling">
    <div class="container f-middle">
      <h4>Top Selling Arts</h4>
    </div>
  </section> -->

<?php $this->load->view('include/footer'); ?>
