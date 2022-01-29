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

    <main class="admin_client_spec" id="admin">
        <div class="container">
                <?php
                        if(count($client_spec) > 0) {
                            foreach ($client_spec as $spec) {
                ?>
                                <div class="flex h-100 w-100">
                                    <div class="client_spec">
                                        <div class="profile_border p-y2">
                                            <div class="grid">
                                                <div class="flex h-100">
                                                    <?php
                                                        if($spec->profile_img_state == 0)
                                                        {
                                                    ?>  
                                                        <div class="image_contain default_profile">
                                                            <img src="<?php echo base_url().$spec->profile_img?>" alt="<?php echo $spec->ID_prefix . $spec->client_id . "profile_img"?> ">
                                                        </div>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                    ?>
                                                        <div class="image_contain">
                                                            <img src="<?php echo base_url("assets/img/profile_img/" . $spec->profile_img)?>" alt="<?php echo $spec->ID_prefix . $spec->client_id . "profile_img"?> ">
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                                <div class="client_info">
                                                    <div class="client_id m-y2">
                                                        <div class="f-w-heavy f-md"><?php echo $spec->ID_prefix . $spec->client_id?></div>
                                                    </div>
                                                    <div class="grid">
                                                        <div class="client_name info_group">
                                                            <div>Name: </div>
                                                            <div class="f-w-heavy f-sm-1"><?php echo $spec->first_name . " " . $spec->last_name?></div>
                                                        </div>
                                                        <div class="client_uname info_group">
                                                            <div>Username: </div>
                                                            <div class="f-w-heavy f-sm-1"><?php echo $spec->username?></div>
                                                        </div>
                                                        <div class="client_email info_group">
                                                            <div>Email: </div>
                                                            <div class="f-w-heavy f-sm-1"><?php echo $spec->email?></div>
                                                        </div>
                                                        <div class="client_gender info_group">
                                                            <div>Gender: </div>
                                                            <div class="f-w-heavy f-sm-1"><?php echo $spec->gender?></div>
                                                        </div>
                                                        <div class="client_age info_group">
                                                            <?php $age = date_diff(date_create($spec->dob), date_create('now'))->y; ?>
                                                            <div>Age: </div>
                                                            <div class="f-w-heavy f-sm-1"><?php echo $age?></div>
                                                        </div>
                                                    </div>
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
    </main>

</body>