    <?php 
        if($access_user_type == "client" ) {
            $this->load->view('include/nav_bar');
        } else if($access_user_type == "admin") {
    ?>
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/payment_style.css ">
    </head>
    <body>
    <?php
            $this->load->view('admin/include/admin_nav');
        }
     ?>
    <main class="receipt">
        <div class="container">
        <?php 
            if(count($payment_data) > 0 && count($user_data) > 0 && count($payment_art_data) > 0) {
                $subtotal = 0;
                $total = 0;
        ?>
            <div class="receipt-head-title grid">
                <h2 class="f-w-heavy f-ls-3">HYDRAULIC JACK</h2>
                <p>
                    Paid by, 
                    <span class="f-w-heavy">
                        <?php echo $user_data[0] -> username ?>   
                    </span>
                </p>
                <h4 class="f-sm">REVIEW RECEIPT</h4>

            </div>

            <hr />

            <div class="receipt-head m-y2 grid">
                <div class="payment-detail">
                    <span class="column-head">Date</span>
                    <br/>
                    <span class="column-body"><?php echo $payment_data[0]->payment_date ?></span>
                </div>
                <div class="payment-detail">
                    <span class="column-head">Order No</span>
                    <br/>
                    <span class="column-body"><?php echo $payment_data[0]->ID_prefix." ".sprintf('%04d', $payment_data[0]->payment_id)  ?></span>

                </div>
                <div class="payment-detail">
                    <span class="column-head">Payment Type</span>
                    <br/>
                    <span class="column-body">
                    <?php
                        if($payment_data[0]->transaction_type == "debit/credit_card") {
                            echo "Credit/Debit Card";
                        } else if($payment_data[0]->transaction_type == "online_banking") {
                            echo "Online Banking";
                        }
                    ?>
                    </span>
                </div>
                <div class="payment-detail">
                    <span class="column-head">Payer Email</span>
                    <br/>
                    <span class="column-body"><?php echo $user_data[0]->email; ?></span>
                </div>
            </div>

            <hr />

            <div class="receipt-products m-y2">
        <?php
            foreach($payment_art_data as $data) {
        ?>
            <div class="grid">
                <div class="product-img-card">
                    <img class="product-img" src="<?php echo base_url().$data->product_img; ?>" alt="product_img">
                </div>
                <div>
                    <p><?php echo $data->ID_prefix." ".sprintf('%04d', $data->product_id)  ?></p>
                    <span class="f-w-heavy product-name"><?php echo $data->product_name; ?></span>
                </div>
                <div class="quantity">
                    QTY: 
                    <span>
                        <?php echo $data->quantity; ?>
                    </span>
                </div>
                <div class="f-w-heavy total">
                    RM 
                    <?php 
                        echo $data->total;
                        $subtotal += $data->total; 
                    ?>
                </div>
            </div>        
        <?php
                    }
        ?>
            </div>
            <hr />
            <?php 
                $total = $subtotal;

                if($total != 0 && $subtotal != 0) {
            ?>
                <div class="total_display m-y2">
                    <div class="subtotal m-y1">
                        <span class="f-w-heavy">Subtotal (RM): </span>
                        <span><?php echo $subtotal ?></span>
                    </div>
                    <div class="total m-y1">
                        <span class="f-w-heavy">Total (RM): </span>
                        <span><?php echo $total ?></span>
                    </div>
                </div>
                <?php 
                    if($access_user_type == "client" ) {
                ?>
                    <div class="f-middle" >
                        <button id="btn-close-pay-history" class="f-w-heavy" type="button">RETURN</button>
                    </div>
                <?php
                    }
                ?>
        <?php
                        }
            } else {
                echo 'ERROR FETCHING DATA FROM DATABASE';
            }
        ?> 
        </div>
    </main>
<?php 
    if($access_user_type == "client" ) {
        $this->load->view('include/footer');
    }
?>