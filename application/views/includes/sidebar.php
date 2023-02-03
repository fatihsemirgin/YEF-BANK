<?php $user = get_active_user(); ?>

<?php if ($user) {; ?>

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href=<?php echo base_url(); ?>>
            <div class="sidebar-brand-icon">
                <i class="fas fa-university"></i>
            </div>
            <div class="sidebar-brand-text mx-3">YEF Bank</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href=<?php echo base_url(); ?>>
                <i class="fas fa fa-home"></i>
                <span>Main Menu</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Account
        </div>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url("account_op"); ?>">
                <i class="fa fa-address-book"></i>
                <span>My Accounts</span>
            </a>

        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Account Operations</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo base_url("transfer"); ?>">Transfer</a>
                    <a class="collapse-item" href="<?php echo base_url("transfer_other"); ?>">Transfer Other Account</a>
                    <a class="collapse-item" href="<?php echo base_url("account_op/new_form"); ?>">New Account</a>

                </div>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url("card_op"); ?>">
                <i class="fa fa-address-card"></i>
                <span>My Cards</span>
            </a>

        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-fw fa-cog"></i>
                <span>Profile and Settings</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo base_url("profile_set/profile"); ?>">Profile</a>
                    <a class="collapse-item" href="<?php echo base_url("profile_set/password"); ?>">Changing Password</a>
                    <a class="collapse-item" href="<?php echo base_url("profile_set/records"); ?>">Login Records</a>
                    <a class="collapse-item" href="<?php echo base_url("profile_set/contact_info"); ?>">Changing Informations</a>
                    <a class="collapse-item" href="<?php echo base_url("profile_set/history"); ?>">Transaction History</a>

                </div>
            </div>
        </li>


    </ul>



<?php } else {; ?>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(); ?>">
            <div class="sidebar-brand-icon">
                <i class="fas fa-university"></i>
            </div>
            <div class="sidebar-brand-text mx-3">YEF Bank</div>
        </a>
    </ul>

<?php }; ?>