  <?php $this->load->view('include/header'); ?>
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/products_style.css ">
  <?php $this->load->view('include/check_login'); ?>
  <?php $this->load->view('include/modal_functions'); ?>
  <script>
    <?php
      if(empty($products_rating) == false) {
    ?>
      var existing_rating = <?php echo $products_rating;?>;
    <?php
      } else {
    ?>
      var existing_rating = "none";
    <?php
      }
    ?>
  </script>

  <script src="<?php echo base_url() ?>assets/js/product.js"></script>
  </head>
  <body>
    <?php $this->load->view('include/nav_bar'); ?>

    <main class="product-details">
      <div class="container f-middle">
        <div class="product-details-hero wrapper p-y3">
        <?php
          if(count($products_info) > 0) {

            foreach ($products_info as $info) {

          echo form_open('cart', array(
              "method" => "get",
              "class" => "product_details_form grid"
          ));
        ?>

          <input type="hidden" name="product_id" value="<?php echo $info->product_id; ?>" id="product_id">
          <input type="hidden" name="stock_amount" value="<?php echo $info->stock_amount; ?>">

          <div class="product-img-card">
            <img class="product-img" src="<?php echo base_url().$info->product_img; ?>" alt="product_img">
          </div>

          <div class="product-text">
            <h1 class="f-w-heavy"><?php echo $info->product_name?></h1>
            <h2 class="f-sm">Artist: <span class="f-w-heavy"><?php echo $info->user_name?></span></h2>
            <p class="product-descript m-y3">
              <?php echo $info->product_descript?>
            </p>
            <div class="product-rating">
              <i class="far fa-star star-1 f-sm" data-rate=1></i>
              <i class="far fa-star star-2 f-sm" data-rate=2></i>
              <i class="far fa-star star-3 f-sm" data-rate=3></i>
              <i class="far fa-star star-4 f-sm" data-rate=4></i>
              <i class="far fa-star star-5 f-sm" data-rate=5></i>
              <span class="rate-text f-sm-ex">( <span>0</span> / 5 )</span>
              <div class="rating-message"></div>
            </div>
            <h3 class="f-sm m-y3">
              <span class="f-w-heavy">Stock Left: </span>
              <span class="stock-amount"><?php echo $info->stock_amount ?></span>
            </h3>

            <div class="quantity m-y1">
              <button class="f-sm quantity-btn" id="decrement-btn" type="button"><i class="fas fa-minus"></i></button>
              <input class="f-middle quantity-field m-x-sm f-w-heavy" type="text" value=1 name="quantity" readonly>
              <button class="f-sm quantity-btn" id="increment-btn" type="button"><i class="fas fa-plus"></i></button>
            </div>

            <button type="submit" class="add-cart m-y3 f-ls-2">Add To Cart</button>
          </div>

        <?php
          echo form_close();
          }
        }
        ?>
        </div>
      </div>

    </main>

    <div class="modal cart-modal">
      <div class="modal-container p-x2">
        <span class="close-btn f-md">&times;</span>
        <div class="modal-info f-middle">
          <p class="cart-message f-w-heavy m-y4"></p>
          <div class="m-y4"><a href="<?php echo base_url('cart') ?>" class="cart-link"></a></div>
        </div>
      </div>
    </div>

    <?php $this->load->view('include/footer'); ?>
