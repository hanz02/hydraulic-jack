<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/check_login'); ?>

<link rel="stylesheet" href="<?php base_url() ?>assets/css/KEYFRAME.css">
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/about_artist_style.css ">
<script src="<?php echo base_url() ?>assets/js/parallax.js"></script>

</head>
<body>
  <?php $this->load->view('include/nav_bar'); ?>

  <main class="about_artist ">
    <div class="parallax_bg"></div>
    <div class="container">
      <div class="flex h-100 banner">
        <h1 class="f-w-heavy">
          HYDRAULIC JACK
          <hr />
        </h1>
        <h4>
          Sponsored by Jack Kang
        </h4>
      </div>
    </div>
  </main>
  
  <div class="about_jack container p-2 f-middle">
    <h2 class="f-w-heavy f-sm-1 about_head m-y2">About Jack</h2>
    <p>
      Fresh-grad generalist capable of concept art, illustration, modelling, texturing, rigging, and animation, but looking to specialize in 3D animation in particular.
      <br/>
      <br/>
      Fluent in Autodesk Maya and Adobe Photoshop. Mild knowledge and prior experience with Marmoset Toolbag 4, Adobe Substance Painter, Adobe After Effects, Toon Boom Studio, and OpenToonz.
    </p>
  </div>
  
  <div class="parallax_img" id="first"></div>

  <div class="about_works container p-2 f-middle">
    <h2 class="f-w-heavy f-sm-1 about_head m-y2">PORTFOLIO WORKS</h2>
    <p>Check out Jack's stunning animation and art works!</p>

    <div class="porfolio_works p-y2">
      <div class="flex">
        <div class="iframe_container">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/tosSH3T6g98" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="iframe_container">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/WDO4M_Tx1JQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="iframe_container">
          <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/-tMQxmtHm6Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="iframe_container">
          <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/wlDqXtKvzo8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="iframe_container">
          <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/ad3GnwY0LNk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
  <div class="parallax_img" id="second"></div>


<?php $this->load->view('include/footer'); ?>
</body>
</html>
