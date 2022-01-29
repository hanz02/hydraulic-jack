<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/check_login'); ?>
<link rel="stylesheet" href="<?php base_url() ?>assets/css/profile_style.css">
<script src="<?php echo base_url() ?>assets/js/profile.js"></script>

</head>
<body>

  <?php $this->load->view('include/nav_bar'); ?>

  <main class="profile-pg">

      <div class="bg-container"></div>
      <?php
            if(count($profile_data) > 0) {

              foreach ($profile_data as $data) {
      ?>
          <div class="container">
            <?php
                echo form_open_multipart('products_control/display_product_details', array(
                    "method" => "POST",
                    "id" => "profile-bg-form"
                ));
            ?>
            <div class="bg-upload-container">
                <input type="file" name="bg-img-upload" id="bgFileInput">
                <label for="file" class="f-middle upload-btn-bg f-sm-ex f-w-heavy flex" id="bgUploadButton">
                  <i class="fas fa-magic"></i>
                  CHANGE BACKGROUND
                </label>
            </div>

            <?php
                echo form_close();
            ?>

            <div class="profile-head flex">
              <?php
                echo form_open_multipart('products_control/display_product_details', array(
                    "method" => "POST",
                    "class" => "profile-img-contain",
                    "id" => "profile-img-form"
                ));
              ?>
       
                  <span></span>
                  <div class="profile-img flex">
                    <?php
                      if($data->profile_img_state === '0') {  
                    ?>
                      <img class="default_profile" src="<?php echo base_url('assets/img/default_account.png')?>" alt="">
                    <?php
                      } else {
                    ?>
                      <img src="<?php echo base_url('assets/img/profile_img/'.$data->profile_img)?>" alt="">
                    <?php
                      }
                    ?> 
                    <input type="file" name="profile-img-upload" id="profileImgFileInput">
                    <label for="file" class="f-middle upload-btn-profile f-sm-ex f-w-heavy flex" id="profileUploadButton">CHANGE PHOTO</label>
                  </div>
              <?php
                echo form_close();
              ?>

              
              <div class="user-name f-middle">
                <h3 class="f-middle f-sm-1 f-w-heavy m-0 f-ls-3"><?php echo $data->username ?></h3>
                <span></span>
              </div>
            </div>
          </div>
        

          <div class="profile-body card p-y4 container grid">

            <div class="users-details f-middle ">

                <div class="profile-title"> PROFILE</div>
              
              <div class="data-user"> 
                <span class="row-header">USER ID: </span>
                <span class="row-data"><?php echo $data->client_id ?> </span>
              </div>
              
              <div class="data-user"> 
                <span class="row-header">USERNAME: </span>
                <span class="row-data"><?php echo $data->username ?> </span>
              </div>
              
              <div class="data-user">
                <span class="row-header">NAME: </span>
                <span class="row-data"><?php echo $data->first_name ?> <?php echo $data->last_name ?> </span>
              </div>
              
              <div class="data-user"> 
                <span class="row-header">DATE OF BIRTH: </span>
                <span class="row-data"><?php echo $data->dob ?> </span>
              </div>
              
              <div class="data-user"> 
                <span class="row-header">GENDER: </span>
                <span class="row-data"><?php echo $data->gender ?> </span>
              </div>
              
              <div class="data-user user_email"> 
                <span class="row-header">EMAIL: </span>
                <span class="row-data"><?php echo $data->email ?> </span>
              </div>
            </div>

            <div class="purchase-history-review flex">
              <h3>PURCHASED PRODUCTS</h3>

              <div class="empty-message f-middle">
                <h5 class="f-middle f-w-heavy">NO PRODUCT PURCHASED YET</h5>
                <a href="products" class="f-sm-ex f-w-heavy f-ls-2">START SHOPPING</a>
              </div>
            </div>

            <?php
                }
              }
            ?>
          </div>
  </main>
  
  <?php $this->load->view('include/footer'); ?>
</body>
</html>