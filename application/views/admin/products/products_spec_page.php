<?php $this->load->view('include/header'); ?>
<?php $this->load->view('admin/include/header'); ?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin_style/product_style.css">
<script src="<?php echo base_url() ?>assets/js/admin/products.js"></script>
<script>
    var base_url = '<?php echo base_url(); ?>';
</script>
</head>
<body>

    <?php $this->load->view('admin/include/admin_nav'); ?>

    <main class="admin_product_spec" id="admin">

        <div class="container">
                    <?php 

                        if(count($products_details) > 0) {
                            
                            foreach ($products_details as $detail) {

                                echo form_open('#', array(
                                    "method" => "POST",
                                    "class" => "product_spec_form"
                                ));
                    ?>
                                    <div class="spec_head">
                                        <div class="grid">
                                            <div class ="flex img_contain">
                                                <div class="product_img">
                                                    <img src="<?php echo base_url().$detail->product_img ?>" alt="<?php echo $detail->product_name?>">
                                                </div>
                                            </div>
                                            <div class="product_text">
                                                <div class="product_id m-y3">
                                                    <input type="hidden" value="<?php echo $detail->product_id ?>" name="product_id" class="product_id">
                                                    <h3 class="f-w-heavy"><?php echo $detail->ID_prefix . " " . $detail->product_id ?></h3>
                                                </div>
                                                <div class="product_name editable_group">
                                                    <div class="title flex">
                                                        <p>NAME</p>
                                                        <span class="edit_btn action_btn"> 
                                                            <span class="text"> EDIT </span> 
                                                            <i class="fas fa-magic"></i>
                                                        </span>
                                                        <span class="cancel_btn action_btn"> 
                                                            <span class="text"> CANCEL </span> 
                                                            <i class="fas fa-times"></i>
                                                        </span>
                                                    </div>
                                                    <span class="editable_text"><?php echo $detail->product_name ?></span>
                                                    <input type="text" value="<?php echo $detail->product_name ?>" name="product_name" class="product_name editable">
                                                </div>
                                                <div class="product_price editable_group">
                                                    <div class="title flex">
                                                        <p>PRICE</p>
                                                        <span class="edit_btn action_btn"> 
                                                            <span class="text"> EDIT </span> 
                                                            <i class="fas fa-magic"></i>
                                                        </span>
                                                        <span class="cancel_btn action_btn"> 
                                                            <span class="text"> CANCEL </span> 
                                                            <i class="fas fa-times"></i>
                                                        </span>
                                                    </div>
                                                    RM
                                                    <span class="editable_text"><?php echo $detail->price ?></span>
                                                    <input type="text" value="<?php echo $detail->price ?>" name="price" class="price editable">
                                                </div>
                                                <div class="product_descript editable_group textarea">
                                                    <div class="title flex">
                                                        <p>DESCRIPTION</p> 
                                                        <span class="edit_btn action_btn"> 
                                                            <span class="text"> EDIT </span> 
                                                            <i class="fas fa-magic"></i>
                                                        </span>
                                                        <span class="cancel_btn action_btn"> 
                                                            <span class="text"> CANCEL </span> 
                                                            <i class="fas fa-times"></i>
                                                        </span>
                                                    </div>
                                                    <span class="editable_text"><?php echo $detail->product_descript ?></span>
                                                    <textarea name="product_descript" cols="40" rows="5" class="product_decsript editable"><?php echo $detail->product_descript ?></textarea>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="spec_body m-y4">
                                                    
                                        <div class="flex">
                                            
                                            <div class="stock_amount editable_group">
                                                <div class="title flex">
                                                    <p>STOCK <br> AMOUNT</p>
                                                    <span class="edit_btn action_btn"> 
                                                        <span class="text"> EDIT </span> 
                                                        <i class="fas fa-magic"></i>
                                                    </span>
                                                    <span class="cancel_btn action_btn"> 
                                                        <span class="text"> CANCEL </span> 
                                                        <i class="fas fa-times"></i>
                                                    </span>
                                                </div>
                                                <span class="editable_text"><?php echo $detail->stock_amount ?></span>
                                                <input type="text" value="<?php echo $detail->stock_amount ?>" name="stock_amount" class="stock_amount editable">
                                            </div>
                                            <div class="product_status">
                                                <div class="title">STATUS</div>

                                                <div class="option-menu">
                                                    <ul class="default-option">
                                                        <li>
                                                            <p class="f-middle">
                                                                <span class="option_text f-w-heavy"><?php echo $detail->product_status?></span>
                                                                <input class="status_selected" type="hidden" name="status_selected" value="<?php echo $detail->product_status?>">
                                                            </p>
                                                        </li>
                                                    </ul>
                                                    <ul class="alt-option">
                                                        <li>
                                                            <p class="f-middle">
                                                                <span class="option_text">Show</span>
                                                                <input class="status_option" type="hidden" name="status_option" value="show">
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <p class="f-middle">
                                                                <span class="option_text">Hidden</span>
                                                                <input class="status_option" type="hidden" name="status_option" value="hidden">
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="main_action_btns flex">
                                        <button class="edit_all_btn" type="button">EDIT ALL <i class="fas fa-hand-sparkles"></i></button>
                                        <button class="update_btn"> 
                                            UPDATE  
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </div>


                    <?php
                                echo form_close();
                    ?>
                                <hr>
                                <div class="spec_report m-y3 f-sm-1 p-y2">
                                    <div class="grid">
                                        <div class="rating_report">
                                            <h3 class="f-middle f-w-heavy">RATINGS</h3>
                                            <div class="grid">
                                                <div class="rating_stars">
                                                    <div>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star fa"></i>
                                                    </div>
                                                    <div>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star "></i>
                                                    </div>
                                                    <div>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                    </div>
                                                    <div>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                    </div>
                                                    <div>
                                                        <i class="far fa-star fa"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="rating_nums">
                                                    <div><?php echo $ratings['five']?></div>
                                                    <div><?php echo $ratings['four']?></div>
                                                    <div><?php echo $ratings['three']?></div>
                                                    <div><?php echo $ratings['two']?></div>
                                                    <div><?php echo $ratings['one']?></div>
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="uneditable_spec">
                                            <div class="grid">
                                                <div class="date_added">
                                                    <div class="title">
                                                        <span class="f-w-heavy">DATE ADDED</span>
                                                    </div>
                                                    <span>
                                                        <?php echo $detail->date_added?>
                                                    </span>
                                                </div>
                                                <div class="date_added">
                                                    <div class="title">
                                                        <span class="f-w-heavy">AMOUNT SOLD</span>
                                                    </div>
                                                    <span>
                                                        <?php echo $detail->amount_sold?>
                                                    </span>
                                                </div>
                                                <div class="total_revenue m-y2">
                                                    <div class="title">
                                                        <span class="f-w-heavy f-sm-2">TOTAL REVENUE / SALES</span>
                                                    </div>
                                                    <span class="f-md f-ls-4 price">
                                                        RM<?php echo $detail->total_revenue?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    
                    <?php
                            }
                        }
                    ?>
        </div>

        <div class="update_alert f-w-heavy">
            <span class="text f-w-heavy">PRODUCT UPDATED</span>
            <i class="fas fa-times-circle"></i>
        </div>

    </main>
    
</body>
</html>