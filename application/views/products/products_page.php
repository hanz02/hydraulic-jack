<?php $this->load->view('include/header'); ?>
<link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/products_style.css ">
<script src="<?php echo base_url() ?>assets/js/product.js"></script>
<script src="<?php echo base_url() ?>assets/js/filter_product.js"></script>

</head>
<body>
  <?php $this->load->view('include/nav_bar'); ?>

  <main class="products">
    <div class="container">
      <h2 class="f-sm-1 f-middle f-w-heavy products-banner">ART WORKS</h2>
      <?php
        if(!empty($all_products))
        {

      ?>
      <div class="filter_selection">
        <div class="flex">
            <div class="filter_product f-middle flex"> 
                <h5 class="f-sm f-w-heavy m-y-sm">
                    Filter
                </h5>
                <div class="option-menu m-x2">
                    <ul class="default-option">
                        <li>
                            <p>
                                <span class="option_text f-w-heavy">Price (Lowest)</span>
                                <input class="filter_selected" type="hidden" name="filter_selected" value="filter_lowest_price">
                            </p>
                        </li>
                    </ul>
                    <ul class="alt-option">
                        <li>
                            <p>
                                <span class="option_text f-w-heavy">Price (Lowest)</span>
                                <input class="filter_option" type="hidden" name="filter_option" value="filter_lowest_price">
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="option_text f-w-heavy">Price (Highest)</span>
                                <input class="filter_option" type="hidden" name="filter_option" value="filter_highest_price">
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="option_text f-w-heavy">Time (Latest)</span>
                                <input class="filter_option" type="hidden" name="filter_option" value="filter_latest">
                            </p>
                        </li>
                        <li>
                            <p>
                                <span class="option_text f-w-heavy">Time (Oldest)</span>
                                <input class="filter_option" type="hidden" name="filter_option" value="filter_oldest">
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
      <div class="products-area f-middle grid">
        <?php

            foreach ($all_products as $product) {
        ?>
        <div class="product-individual">
        <?php
              echo form_open('products_control/display_product_details', array(
                  "method" => "get",
                  "class" => "product-lists-form flex"
              ));
        ?>
              <input type="hidden" name="product_id" value="<?php echo $product->product_id ?>"/>
              <div class="product-img-card">
                <img class="product-img" src="<?php echo base_url().$product->product_img; ?>" alt="product_img">
              </div>
              <div class="product-info">
                <div class="product-name-link">
                  <?php
                    if($product->stock_amount > 0)
                    {
                       echo '<button class="name-link f-sm">'.$product->product_name .'</button>';
                    } else {
                      echo '<p class="product-name f-sm">'.$product->product_name .'</p>';
                    }
                  ?>
                </div>
                <div class="artist-name"><h4><span class="f-w-heavy">Artist: </span><?php echo $product->user_name; ?></h4></div>
                <div class="product-price"><h4 class="f-w-heavy">RM <?php echo $product->price; ?></h4></div>
                <?php
                if($product->stock_amount > 0) {
                  echo '<button class="shop-now-btn m-y1">Shop Now</button>';
                } else {
                  echo '<div class="out-stock-msg ls-1 m-y1">
                          <p class="f-w-heavy m-y-ex f-sm-ex">OUT OF STOCK</p>
                        </div>';
                }
                ?>
              </div>
        <?php
              echo form_close();
        ?>
        </div>
        <?php
            }
          }
          else
          {
            ?>
            <div class="flex empty-message m-4">
                <h4 class="f-w-heavy m-y4 p-2 f-sm-1 f-middle">There are currently no products on the shelves</h4>
            </div>
          <?php
          }
        ?>
      </div>

    </div>
  </main>

<?php $this->load->view('include/footer'); ?>
