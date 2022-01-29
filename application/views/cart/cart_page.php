  <?php $this->load->view('include/header'); ?>
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/cart_style.css ">
  <script src="<?php echo base_url() ?>assets/js/cart.js"></script>
  <?php $this->load->view('include/check_login'); ?>

  </head>
  <body>
    <?php $this->load->view('include/nav_bar'); ?>

    <main class="cart">
        <?php
          if($cart_products > 0) {
        ?>
        <div class="container">
          <h2 class="f-sm-1 f-middle f-w-heavy">MY CART</h2>
          <div class="cart-products grid">
        <?php
            foreach ($cart_products as $product) {
              echo form_open('cart', array(
                  "method" => "get",
                  "class" => "cart-product-form"
              ));
        ?>
              <div class="cart-item p-1 grid">
                <input type="hidden" name="cart_id" class="cart_id " value="<?php echo $product->cart_id ?>">
                <input type="hidden" name="stock_amount" class="stock-amount " value="<?php echo $product->stock_amount ?>">
                <div class="product-img-card">
                  <img class="product-img" src="<?php echo $product->product_img; ?>" alt="product_img">
                </div>
                <div class="product-info">
                  <button class="f-sm product-name"><?php echo $product->product_name; ?></button>
                  <p class="f-sm-ex product-descript"><?php echo $product->product_descript; ?></p>
                </div>
                <div class="product-price">
                  <input type="hidden" id="price" value="<?php echo $product->price; ?>">
                  <h3 class="f-sm product-price">RM <?php echo $product->price; ?></h3>
                </div>
                <div class="item-btn grid">
                  <?php
                    if($product->stock_amount > 0) {
                  ?>
                      <div class="quantity m-y1">
                        <button class="f-sm quantity-btn decrement-btn" type="button"><i class="fas fa-minus"></i></button>
                        <input class="f-middle quantity-field m-x-sm f-w-heavy" type="text" value=<?php echo $product->quantity ?> name="quantity" readonly>
                        <button class="f-sm quantity-btn increment-btn" type="button"><i class="fas fa-plus"></i></button>
                      </div>
                  <?php
                    } else {
                  ?>
                      <div class="out-stock m-y1">
                        <p class="f-sm f-middle f-w-heavy">OUT OF STOCK</p>
                      </div>
                  <?php
                    }
                  ?>

                  <button type="submit" class="remove-product">
                    <input class="product_id" type="hidden" value="<?php echo $product->product_id ?>" name="product_id">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <div class="alert">
                    <div class="flex p-x1">
                      <p class="alert-msg f-middle f-sm-ex">
                      </p>
                      <span class="close-btn f-sm"><i class="fas fa-times-circle"></i></span>
                    </div>
                  </div>
                </div>
              </div>
        <?php
              echo form_close();
            }
        ?>
         </div>
       </div>

         <div class="total-banner flex p-1">
           <div class="total-banner-text">
             <div class="item-count grid">
               <span class="f-w-heavy">Total Items: </span>
               <span class="value f-sm"></span>
             </div>
             <div class="subtotal grid">
               <span class="f-w-heavy">Subtotal (RM): </span>
               <span class="value"></span>
             </div>
             <div class="total grid">
               <span class="f-w-heavy">Total (RM): </span>
               <span class="value"></span>
             </div>
           </div>
           <div>
             <button class="checkout-btn">CHECKOUT</button>
           </div>
         </div>
        <?php
          } else {
        ?>
          <div class="empty-cart">
            <div class="empty-cart-msg p-x1 f-middle">
              <h1 class="f-w-heavy">OOPS! YOUR CART IS EMPTY</h1>
              <a class="m-y2" href="<?php echo base_url('products') ?>">CONTINUE SHOPPPING</a>
            </div>
          </div>
        <?php
          }
        ?>
    </main>

  </body>
</html>
