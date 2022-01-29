<?php $this->load->view('include/header'); ?>
 <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/payment_style.css ">
 <script src="<?php echo base_url() ?>assets/js/payment.js"></script>
 <?php $this->load->view('include/check_login'); ?>

</head>
<body>
    <?php $this->load->view('include/nav_bar'); ?>

    <main class="payment">
        <div class="container grid">

            <div class="pay-method">
                <div class="pay-option-labels grid f-middle">
                    <div class="option active" id="card-debit-credit">
                        <h4 class="m-y-sm f-sm-ex f-w-heavy">CREDIT/DEBIT CARD <i class="fas fa-credit-card m-x-sm"></i></h4>
                    </div>
                    <div class="option" id="online-banking">
                        <h4 class="m-y-sm f-sm-ex f-w-heavy">ONLINE BANKING <i class="fas fa-laptop m-x-sm"></i></h4>
                    </div>
                </div>
                
                <div class="card-form-wrap m-y2 p-1 pay-form active" data-pay-form="card-debit-credit">
                    <?php echo form_open('payment_control/to_record_payment', array(
                        "method" => "POST",
                        "class" => "card-payment-form"
                    ))?>

                        <input type="hidden" name="total-amount" value="<?php echo $calc_result['total'] ?>">
                        <input type="hidden" name="transact-type" value="debit/credit_card">
                        
                        <div class="pay-card-img flex">
                            <img src="<?php echo base_url('assets/img/payment/visa_logo.png')?>" alt="">
                            <img class="m-x-sm" src="<?php echo base_url('assets/img/payment/master_logo.png')?>" alt="">
                        </div>
                        <div class="form-group mandatory grid">
                            <label for="card-no"><p>Card Number <span class="asterisk">*</span></p></label>
                            <input type="text" name="card-no" class="card-no" required>
                        </div>
                        <div class="form-group mandatory grid">
                            <label for="card-name"><p>Name on card <span class="asterisk">*</span></p></label>
                            <input type="text" name="card-name" class="card-name" required>
                        </div>
                        <div id="date-cvv" class="grid">
                            <div class="form-group mandatory grid">
                                <label for="card-no"><p>Expiration date <span class="asterisk">*</span></p></label>
                                <input type="text" name="card-exp-date" class="card-exp-date" required>
                            </div>
                            <div class="form-group mandatory grid">
                                <label for="card-no"><p>CVV <span class="asterisk">*</span></p></label>
                                <input type="text" name="card-cvv" class="card-cvv" required>
                            </div>
                        </div>

                        <button class="pay-btn p-y1 f-ls-2" type="submit">MAKE PAYMENT</button>
                    <?php echo form_close() ?>
                </div>

                <div class="online-banking-form-wrap pay-form m-y2 p-1" data-pay-form="online-banking">
                    <h3 class="f-sm">You will be redirected to respective bank website for payment completion</h3>
                    
                    <?php echo form_open('payment_control/to_record_payment', array(
                            "method" => "POST",
                            "class" => "online-bank-payment-form grid"
                    ))?>
                        
                    <input type="hidden" name="total-amount" value="<?php echo $calc_result['total'] ?>">
                    <input type="hidden" name="transact-type" value="online_banking">
                    
                    <div class="bank-option" id="cimb">
                        <img src="<?php echo base_url('assets/img/payment/cimb-logo.png')?>" alt="">
                        <p>CIMB Bank</p>
                        <span class="select-tick"></span>
                    </div>
                    <div class="bank-option" id="islam">
                        <img src="<?php echo base_url('assets/img/payment/bank-islam.png')?>" alt="">
                        <p>Bank Islam</p>
                        <span class="select-tick"></span>
                    </div>
                    <div class="bank-option" id="maybank">
                        <img src="<?php echo base_url('assets/img/payment/maybank.png')?>" alt="">
                        <p>Maybank</p>
                        <span class="select-tick"></span>
                    </div>
                    <div class="bank-option" id="hongleong">
                        <img src="<?php echo base_url('assets/img/payment/hongleong_logo.png')?>" alt="">
                        <p>Hong Leong Bank</p>
                        <span class="select-tick"></span>
                    </div>
                    <div class="bank-option" id="rhb">
                        
                        <img src="<?php echo base_url('assets/img/payment/rhb-logo.png')?>" alt="">
                        <p>RHB Bank</p>
                        <span class="select-tick"></span>
                    </div>

                    <div class="alert">
                        <div class="flex p-x1">
                            <p class="alert-msg f-middle f-sm f-w-heavy">
                                Please select a bank
                            </p>
                            <span class="close-btn f-sm"><i class="fas fa-times-circle"></i></span>
                        </div>
                    </div>

                    <button type="submit" class="pay-btn p-y1 f-ls-2">MAKE PAYMENT</button>
                    <?php echo form_close() ?>
                </div>
            </div>

            <div class="cost-summary card">
                <h3 class="f-w-heavy">ORDER SUMMARY</h3>
                <?php if(count($calc_result) > 0) {
                    
                ?>
                    <div class="subtotal quantity">
                        <p>
                            <span class="f-w-heavy">Subtotal </span>(<span><?php echo $calc_result['quantity'] ?></span> Items): 
                            <span class="m-x-sm">RM<?php echo $calc_result['subtotal'] ?></span>
                        </p>
                    </div>
                    <div class="total">
                        <p class="f-sm-1"> 
                            <span class="f-w-heavy">Total: </span>
                            <span class="f-sm-2 f-w-heavy value">RM<?php echo $calc_result['total'] ?></span>
                        </p>
                    </div>  
                <?php    
                } else {
                    redirect('cart');
                }   
                ?>
            </div>
        </div>
    </main>

    <?php $this->load->view('include/footer'); ?>
</body>
</html>