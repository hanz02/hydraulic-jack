 <?php $this->load->view('include/header'); ?>
 <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/payment_style.css ">
 <script src="<?php echo base_url() ?>assets/js/cart.js"></script>
 <?php $this->load->view('include/check_login'); ?>

</head>
<body>
    <?php $this->load->view('include/nav_bar'); ?>

    <main class="checkout">
        <div class="container grid">
            <?php
            if($cart_products > 0) {
            ?>
                <div class="items-list grid">
                <h3 class="f-w-heavy f-middle">SHOPPING CART</h3>
            <?php
                foreach ($cart_products as $product) {
            ?> 
                    <div class="item grid">
                        <div class="product-img-card">
                           <img class="product-img" src="<?php echo base_url().$product->product_img; ?>" alt="product_img">
                        </div>
                        <div class="item-details">
                            <h4 class="f-w-heavy product-name"><?php echo $product->product_name; ?></h4>
                            <?php 
                                if($product->stock_amount > 0) 
                                {
                            ?>
                                    <div class="quantity">
                                        <span class="f-w-heavy">QTY: </span>
                                        <span class="quantity-field m-x1"><?php echo $product->quantity; ?></span>
                                    </div>
                            <?php 
                                 } else {
                            ?>  
                                    <div class="stock-empty-alert f-middle p-y-sm">OUT OF STOCK</div>
                            <?php
                                 }
                            ?>
                        </div>
                        <div class="item-price">
                            <span class="f-w-heavy">RM</span>
                            <span class="price-field">
                                <?php echo $product->price ?>
                            </span>
                        </div>
                    </div>
            <?php
                }
            ?>
                </div>
            
            <?php 
                echo form_open('payment_control/to_make_payment', array(
                    "method" => "post",
                    "class" => "checkout-form"
                ));
            ?>  
                <div class="grid card">
                    <h3 class="f-w-heavy f-middle">ORDER SUMMARY</h3>
                    <div>
                        <span class="f-w-heavy item-count">Subtotal (<span class="value"></span> items): </span>
                        <span class="subtotal">
                            <span class="value"></span>
                        </span>
                    </div>
                    <div class="total">
                        <span class="f-w-heavy">Total: </span>
                        <span class="value f-sm-2 f-w-heavy"></span>
                    </div>
                </div>  
                <div class="grid card">
                    <h3 class="f-w-heavy f-middle">CHECKOUT</h3>
                    <p class="f-sm">Please enter your email address. So we can send you the order status of your purchased goods!</p>
                    <div class="email">
                        <input type="email" name="email-field" class="email-field" required>
                        
                        <div class="alert">
                            <div class="flex p-x1">
                                <p class="alert-msg f-middle f-sm-ex f-w-heavy"></p>
                                <span class="close-btn f-sm"><i class="fas fa-times-circle"></i></span>
                            </div>
                        </div>
                    </div>    
                    <div class="term-cond">
                        <div class="flex">
                            <input type="checkbox" name="term-cond-checkbox" required>
                            <span class="term-cond-text f-sm-ex f-w-heavy m-x1">I agree with <a href="#" class="f-w-heavy">Terms & Conditions</a></span>
                        </div>
                        <div class="alert">
                            <div class="flex p-x1">
                                <p class="alert-msg f-middle f-sm-ex f-w-heavy p-x1"></p>
                                <span class="close-btn f-sm"><i class="fas fa-times-circle"></i></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="place-order-btn">PLACE ORDER</button>
                </div>   
            <?php
                echo form_close();
            } else {
                redirect('login');
            }
            ?>
        </div>
    </main>

    <?php $this->load->view('include/footer'); ?>
