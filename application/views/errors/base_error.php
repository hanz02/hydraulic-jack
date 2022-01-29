<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/check_login'); ?>
<link rel="stylesheet" href="<?php base_url() ?>assets/css/error.css">

</head>
<body>
<?php $this->load->view('include/nav_bar'); ?>


    <main class="base_error">

        <div class="flex">
            <div class="message f-middle p-3">
                <div><i class="fas fa-exclamation-circle"></i></div>
                <div class="message__text">
                    <h3 class="f-sm-2 f-w-heavy">Oops! An unexpected error has happened, we will be fixing it in no time!</h3>
                </div>
                <a href="products">CONTINUE</a>
            </div>
        </div>

</main>

<?php $this->load->view('include/footer'); ?>
</body>
</html>