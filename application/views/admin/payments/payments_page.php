<?php $this->load->view('include/header'); ?>
<?php $this->load->view('admin/include/header'); ?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin_style/payments_style.css">
<script src="<?php echo base_url() ?>assets/js/admin/payments.js"></script>
<script>
    var base_url = '<?php echo base_url(); ?>';
</script>
</head>
<body>

    <?php $this->load->view('admin/include/admin_nav') ?>

    <main class="admin_payment" id="admin">
        <div class="container">
            <h3 class="f-middle f-w-heavy">PAYMENT HISTORY</h3>
            <div class="filter_selection">
                <div class="flex">
                    <div class="filter_payment f-middle flex"> 
                        <h5 class="f-sm f-w-heavy m-y-sm">
                            Filter
                        </h5>
                        <div class="option-menu m-x2">
                            <ul class="default-option">
                                <li>
                                    <p>
                                        <span class="option_text f-w-heavy">Date (Latest)</span>
                                        <input class="filter_selected" type="hidden" name="filter_selected" value="filter_latest_payment">
                                    </p>
                                </li>
                            </ul>
                            <ul class="alt-option">
                                <li>
                                    <p>
                                        <span class="option_text f-w-heavy">Date (Latest)</span>
                                        <input class="filter_option" type="hidden" name="filter_option" value="filter_latest_payment">
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        <span class="option_text f-w-heavy">Date (Oldest)</span>
                                        <input class="filter_option" type="hidden" name="filter_option" value="filter_oldest_payment">
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="result">
                <?php
                        if(count($payment_data) > 0) {
                            
                            foreach ($payment_data as $data) {
                                echo form_open('admin/payment_control/view_payment_spec', array(
                                    "method" => "GET",
                                    "class" => "view_pay_spec_form"
                                ));
                                //* WHEN THIS FORM GETS SUBMITTED, WE PASS ON 'PRODUCT_ID', 'CLIENT_ID' AND 'PAYMENT_ID' TO GET THE RECEIPT
                            ?>
                                <div class="payment_contain m-y4">
                                    <div class="flex">

                                        <div class="product_id f-w-heavy f-left">
                                            <?php echo $data->payment_ID_prefix . " " . $data->payment_id ?>
                                            <input type="hidden" name="payment_id" value="<?php echo $data->payment_id ?>">
                                            <!-- //* PAYMENT ID HERE -->
                                        </div>

                                        <div class="product_info m-y2">

                                                <div class="product_img">
                                                    <img src="<?php echo base_url().$data->product_img ?>" alt="">
                                                    <input type="hidden" value="<?php echo $data->product_id ?>" name="product_id" class="product_id">
                                                    <!-- //* PRODUCT ID HERE -->
                                                </div>

                                                <div>
                                                    <a href="#" class="product_name f-w-heavy"><?php echo $data->product_name?></a>
                                                </div>

                                        </div>


                                        <div class="grid payment_info">

                                            <div class="pay_amount f-middle m-x2 table_cell">
                                                <div class="table_head">
                                                    AMOUNT
                                                </div>
                                                <div class="table_body m-y1 f-sm-1">
                                                    RM<?php echo $data->total?>
                                                </div>
                                            </div>

                                            <div class="pay_quant table_cell">
                                                <div class="table_head">
                                                    QTY
                                                </div>
                                                <div class="table_body">
                                                    <?php echo $data->quantity?>
                                                </div>
                                            </div>

                                            <div class="pay_date table_cell">
                                                <div class="table_head">
                                                    DATE OF 
                                                    PAYMENT
                                                </div>
                                                <div class="table_body">
                                                    <?php echo $data->payment_date?>
                                                </div>
                                            </div>

                                            <div class="pay_type table_cell">
                                                <div class="table_head">
                                                    TRANSACTION <br />
                                                    TYPE
                                                </div>
                                                <div class="table_body">
                                                    <?php echo $data->transaction_type?>
                                                </div>
                                            </div>
                                            
                                            <div class="payer_name table_cell">
                                                <div class="table_head">
                                                    PAYER:
                                                </div>
                                                <div class="table_body">
                                                    <?php echo "ID: " . $data->client_ID_prefix ." ". $data->client_id?>
                                                    <input type="hidden" name="client_id" value="<?php echo $data->client_id ?>">
                                                    <!-- //** PAYMENT ID HERE -->
                                                    <br />
                                                    <?php echo $data->username?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="view_details_btn">
                                        <button type="submit" class="f-w-heavy">VIEW DETAILS</button>
                                    </div>
                                </div>
                
                <?php
                                echo form_close();
                            }
                        }
                ?>
            </div>
            
        </div> 
    </main>

</body>