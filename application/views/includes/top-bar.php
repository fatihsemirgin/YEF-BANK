<?php $user = get_active_user();
?>
<?php if ($user) { ?>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <?php
        // print_r($user);
        if ($user->Wrong_Login == "1") {
            $user->Wrong_Login = "0";   // for reload page without login
            $temp_str = "";
            foreach ($user->log_ins as $log) {
                $temp_str .= '<span>' . $log->Date . '</span><br>';
            }
            $temp_str = ltrim($temp_str, ",");
            echo "<script>
                    Swal.fire({
                        icon : 'error',
                        title: '<i>Wrong Log-ins</i>', 
                        html: '$temp_str',  
                    });
                    </script>";
        }; ?>
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo ($user->First_Name . ' ' . $user->Last_Name); ?></span>
                    <img class="img-profile rounded-circle" src="<?php echo base_url("resources/assets/") ?>img//undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    
                
                    <a class="dropdown-item" href="<?php echo base_url("customer_op/logout"); ?>">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>

    <!-- Logout Modal-->

<?php } else { ?>

    <nav class="d-flex justify-content-end navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Topbar Search -->




        <div class="row align-items-center" style="width: 400px">
            <div class="col-md-4">
                <a style="text-decoration: none;" class="text-color" href="<?php echo base_url("customer_op/login_form"); ?>">
                    <button class="btn btn-primary btn-block">Log-in</button>
                </a>
            </div>
            <div class="col-md-4">
                <a style="text-decoration: none;" class="text-color" href="<?php echo base_url("customer_op/register_form"); ?>">
                    <button class="btn btn-warning btn-block">Register</button>
                </a>
            </div>
            <div class="col-md-4">
<!--                <a style="text-decoration: none;" class="text-color" href="--><?php //echo base_url("admin"); ?><!--">-->
<!--                    <button id="admin-button" class="btn btn-danger btn-block">Admin</button>-->
<!--                </a>-->
                <a style="text-decoration: none;" class="text-color" href="<?php echo base_url("admin/login_page"); ?>">
                    <button id="admin-button" class="btn btn-danger btn-block">Admin</button>
                </a>
            </div>
        </div>


    </nav>


<?php } ?>