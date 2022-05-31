<?php $this->load->view('include/header'); ?>
<?php $this->load->view('admin/include/header'); ?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin_style/home_style.css">

</head>
<body>

    <?php $this->load->view('admin/include/admin_nav'); ?>

    <main class="admin_home" id="admin">
        <div class="container flex">

            <div class="flex">
                <h2 class="f-w-heavy f-middle f-ls-2">ADMIN DASHBOARD</h2>
                <a class="home_select" href="<?php echo site_url('admin/products_control') ?>">
                    <div class="home_icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <p>MANAGE PRODUCTS</p>
                </a>
                <a class="home_select" href="<?php echo site_url('admin/payment_control') ?>">
                    <div class="home_icon">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <p>VIEW PAYMENTS</p>
                </a>
                <a class="home_select" href="<?php echo site_url('admin/clients_control') ?>">
                    <div class="home_icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <p>VIEW CLIENTS</p>
                </a>
                <!-- <a class="home_select" href="#">
                    <div class="home_icon">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <p>ART COMMISSION</p>
                </a> -->
            </div>
        </div>
    </main>
</body>
</html>