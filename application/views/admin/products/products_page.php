<?php $this->load->view('include/header'); ?>
<?php $this->load->view('admin/include/header'); ?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin_style/product_style.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin_style/uploadProduct_style.css">
<script src="<?php echo base_url() ?>assets/js/admin/products.js"></script>
<script src="<?php echo base_url() ?>assets/js/admin/uploadProduct.js"></script>

</head>
<body>

    <?php $this->load->view('admin/include/admin_nav'); ?>
    <main class="admin_products" id="admin">

        <div class="container">

            <h3 class="f-w-heavy f-middle">MANAGE PRODUCTS</h3>
                <div class="add_product">
                    <button type="button">ADD PRODUCTS</button>
                </div>

            <?php 
                    if($all_products != "empty") {

                        if(count($all_products) > 0) {
                            foreach ($all_products as $product) {

                                echo form_open('admin/products_control/view_product_spec', array(
                                    "method" => "GET",
                                    "class" => "individual_product_form"
                                ));
                        ?>
                                    <div class="product_contain">
                                        <div class="grid">
                                            <div class="product_id f-w-heavy"> 
                                                <?php echo $product->ID_prefix . " " . $product->product_id?>
                                                <input type="hidden" value="<?php echo $product->product_id?>" name="product_id" class="product_id">
                                            </div>
                                            <div class="product_img">
                                                <img src="<?php echo base_url().$product->product_img?>" alt="<? echo $product->product_name?>" />
                                            </div>
                                            <div class="product_name f-middle"> 
                                                <a href="#"><?php echo $product->product_name?></a>
                                            </div>
                                            <div class="product_price"> 
                                                <h5 class="f-sm f-w-heavy m-y-sm">
                                                    PRICE
                                                </h5>
                                                <?php echo $product->price?>
                                            </div>
                                            <div class="product_date"> 
                                                <h5 class="f-sm f-w-heavy m-y-sm">
                                                    DATE ADDED
                                                </h5>
                                                <?php echo $product->date_added?>
                                            </div>
                                            <div class="product_status"> 
                                                <h5 class="f-sm f-w-heavy m-y-sm">
                                                    STATUS
                                                </h5>

                                                <div class="option-menu">
                                                    <ul class="default-option">
                                                        <li>
                                                            <p>
                                                                <span class="option_text f-w-heavy"><?php echo $product->product_status?></span>
                                                                <input class="status_selected" type="hidden" name="status_selected" value="<?php echo $product->product_status?>">
                                                            </p>
                                                        </li>
                                                    </ul>
                                                    <ul class="alt-option">
                                                        <li>
                                                            <p>
                                                                <span class="option_text">Show</span>
                                                                <input class="status_option" type="hidden" name="status_option" value="show">
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <p>
                                                                <span class="option_text">Hidden</span>
                                                                <input class="status_option" type="hidden" name="status_option" value="hidden">
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="action_btns">
                                            <span>
                                                <a href="#" class="edit_product_btn f-w-heavy f-sm-ex">EDIT PRODUCT</a>
                                            </span>

                                            <span>
                                                <a href="#" class="remove_product_btn f-w-heavy f-sm-ex">REMOVE PRODUCT</a>
                                            </span>
                                        </div>

                                    </div>
                        <?php
                                echo form_close();
                            }
                        }
                    } else {
                        ?>
                            <div class="flex">

                                <h4 class="f-w-heavy">YOU DO NOT HAVE ANY PRODUCTS ON THE SHELVES</h4>
                            
                            </div>
                        <?php
                    }
            ?>
        </div>

        <div class="update_alert f-w-heavy">
            <span class="text f-w-heavy">PRODUCT UPDATED</span>
            <i class="fas fa-times-circle"></i>
        </div>

        <div class="modal" id="confirm_delete">
            <div class="modal-container p-x2">
                <span class="close-btn f-md">&times;</span>
                <div class="modal-info f-middle confirm-modal">
                    <p class="confirm-message f-w-heavy m-y4 lh-1"></p>
                    <div class="modal-btn">
                        <div class="flex">
                            <button>
                                CANCEL
                            </button>
                            <button>
                                DELETE
                            </button>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="adding_product">
            <?php
                echo form_open_multipart('products_control/display_product_details', array(
                    "method" => "POST",
                    "class" => "upload_product_form w-100"
                ));
            ?>
            <input type="file" name="productImgUpload" id="productImgUpload">
            <div class="modal-container p-x2">
                <span class="close-btn f-md m-x2">&times;</span>
                <div class="modal-info f-middle">

                    <h3 class="f-w-heavy">ADD NEW PRODUCT</h3>
                    <div class="grid w-100">
                        <div class="upload_product_img">
                            <div class="img_contain flex">
                                <div class="wrapper">
                                    <img class="uploaded_img" id="product_img"src="<?php echo base_url('assets/img/default_upload_product_img.jpg')?>" alt="UPLOAD YOUR IMAGE HERE">
                                </div>
                            </div>
                            <input class="upload_productImg_btn" type="button" value="UPLOAD IMAGE" name="submit">
                        </div>
                        <div class="product_info">
                            <div class="w-100 flex upload_alert m-y1">
                                <div class="flex">
                                    <div class="text f-w-heavy">
                                        PRODUCT UPDATED
                                    </div>
                                    <div>
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="form_group">
                                    <div class="f-w-heavy">NAME: </div>
                                    <input type="text" name="product_name" class="mandatory">
                                </div>

                                <div class="form_group">
                                    <div class="f-w-heavy">STOCK AMOUNT: </div>
                                    <input type="text" name="stock_amount" class="mandatory">
                                </div>
                                <div class="form_group product_price">
                                    <div class="f-w-heavy">PRICE: </div>
                                    <div class="flex">
                                        <span class="f-w-heavy">
                                            RM
                                        </span>
                                        <input type="text" name="product_price" class="mandatory">
                                    </div>
                                </div>
                                <div class="form_group">
                                    <div class="product_status"> 
                                        <h5 class="f-sm f-w-heavy m-y-sm">
                                            STATUS
                                        </h5>

                                        <div class="option-menu">
                                            <ul class="default-option">
                                                <li>
                                                    <p>
                                                        <span class="option_text f-w-heavy">Show</span>
                                                        <input class="status_selected" type="hidden" name="status_selected" value="show">
                                                    </p>
                                                </li>
                                            </ul>
                                            <ul class="alt-option">
                                                <li>
                                                    <p>
                                                        <span class="option_text f-w-heavy">Show</span>
                                                        <input class="status_option" type="hidden" name="status_option" value="show">
                                                    </p>
                                                </li>
                                                <li>
                                                    <p>
                                                        <span class="option_text f-w-heavy">Hidden</span>
                                                        <input class="status_option" type="hidden" name="status_option" value="hidden">
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_group product_decript">
                                    <div class="f-w-heavy">DESCRIPTION: </div>
                                    <textarea name="product_descript" class="mandatory" cols="40" rows="5" class="product_decsript"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="add_product_btn">ADD PRODUCT</button>
                        </div>
                    </div>  
                </div>
            </div>
        <?php
            echo form_close();
        ?>
        </div>

    </main>
    
</body>
</html>