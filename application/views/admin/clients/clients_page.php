    <?php $this->load->view('include/header'); ?>
    <?php $this->load->view('admin/include/header'); ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin_style/clients_style.css">
    <script src="<?php echo base_url() ?>assets/js/admin/clients.js"></script>
    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>
</head>
<body>

    <?php $this->load->view('admin/include/admin_nav') ?>

    <main class="admin_clients" id="admin">
        <div class="container">
            <h3 class="f-middle f-w-heavy f-sm-1 m-y4">VIEW CLIENTS</h3>
            <div class="grid">
                <?php
                        if(count($clients_data) > 0) {
                            foreach ($clients_data as $data) {
                                echo form_open('admin/clients_control/view_client_spec_post', array(
                                    "method" => "POST",
                                    "class" => "individual_client_form"
                                ));
                ?>
                                    <div class="individual_client f-middle">
                                        <div class="grid">
                                            <div class="profile_img">
                                                <div class="profile_img_contain">
                                                <?php
                                                    if($data->profile_img_state == 0)
                                                    {
                                                ?>
                                                        <img class="default_profile" src="<?php echo $data->profile_img?>" alt="<?php echo $data->ID_prefix . $data->client_id . "profile_img"?> ">
                                                <?php
                                                    }
                                                    else
                                                    {
                                                ?>
                                                        <img src="<?php echo base_url("assets/img/profile_img/" . $data->profile_img)?>" alt="<?php echo $data->ID_prefix . $data->client_id . "profile_img"?> ">
                                                <?php
                                                    }
                                                ?>
                                                </div>
                                            </div>
                                            <div class="client_info f-middle">
                                                <div class="client_id f-w-heavy">
                                                    <?php echo $data->ID_prefix . $data->client_id ?>
                                                    <input type="hidden" name="client_id" value="<?php echo $data->client_id?>">
                                                </div>
                                                <div class="client_name">
                                                    <div>NAME</div>
                                                    <div class="f-w-heavy"><?php echo $data->username?></div>   
                                                </div>
                                                <div class="client_email">
                                                    <div>EMAIL</div>
                                                    <div class="f-w-heavy"><?php echo $data->email?></div>   
                                                </div>
                                                <div class="client_gender">
                                                    <div>GENDER</div>
                                                    <div class="f-w-heavy"><?php echo $data->gender?></div>   
                                                </div>
                                            </div>
                                        </div>
                                        <button class="view_spec_btn ">
                                            <span class="f-w-heavy">VIEW</span>
                                        </button>
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