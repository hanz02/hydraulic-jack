<header class='nav admin_nav'>
        <nav class="grid">
            
            <div class="admin_hamburger flex">
                <i class="f-sm-1 bar fas fa-bars"></i>
            </div>

            <div class="logo f-middle flex">
                <h1 class="f-w-heavy f-ls-3">HYDRAULIC JACK</h1>
            </div>

            <div class="nav-profile flex">
                    <?php
                    if($this->session->has_userdata('login_admin') == true || $this->session->userdata('login_admin') == "1") {
                    ?>
                    <?php
                    if($this->session->has_userdata('profile_img_state_admin') == true && $this->session->userdata('profile_img_state_admin') == 1) {
                    ?> 
                        <div class="profile-btn active f-sm-ex f-ls-1">
                            <img src="<?php echo base_url('assets/img/profile_img/admin') . $this->session->userdata('login_profile_img_admin') ?>" alt="profile img">
                        </div>
                    <?php
                        } else {
                    ?>
                        <div class="profile-btn f-sm-ex f-ls-1">
                            <img src="<?php echo base_url().$this->session->userdata('login_profile_img_admin') ?>" alt="profile default img">
                        </div>
                    <?php
                        }
                    ?>  
                        <span class="username">
                        <?php echo $this->session->userdata('username_admin') ?>
                        </span>
                        <div class="profile-menu">
                            <ul class=" f-middle">
                                <!-- <li class="p-y1 f-sm-ex"><a href="">VIEW PROIFLE</a></li> -->
                                <li class="p-y1 f-sm-ex"><a href="<?php echo site_url('admin/admin_control/logout') ?>">LOGOUT</a></li>
                            </ul>
                        </div>
                    <?php
                    } else if ($this->session->userdata('login') == "0" || $this->session->has_userdata('login') == false) {
                        echo '<div> admin_acc </div>';
                    }
                    ?>
            </div>
        </nav>
</header>

<div class="side-menu">
    <ul class="flex p-2">
        <li>
            <a class="f-sm-ex" href="<?php echo site_url('hj-admin') ?>">
                <i class="fas fa-house-user"></i>
                DASHBOARD
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/products_control') ?>">
                <i class="fas fa-palette"></i>
                MANAGE PRODUCTS
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/payment_control') ?>">
                <i class="fas fa-money-check-alt"></i>
                VIEW PAYMENTS
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('admin/clients_control') ?>">
                <i class="fas fa-user-friends"></i>
                VIEW CLIENTS
            </a>
        </li>
        <!-- <li>
            <a href="#">
                <i class="fas fa-user-clock"></i>
                ART COMMISSIONS
            </a>
        </li> -->
    </ul>
</div>