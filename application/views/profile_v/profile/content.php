<?php $user = get_active_user(); ?>
<div class="container">
    <h2 class="text-center">Profile</h2>
    <div class="row text-center mt-5">
        <div class="col-sm-2 offset-sm-5">
            <img class="img-profile rounded-circle" src="<?php echo base_url("resources/assets/") ?>img//undraw_profile.svg">
        </div>
    </div>
    <div class="row mt-5 font-weight-bold font-italic">
        <div class="col-sm-12 text-center ">
            <h5>Identity No: <?php echo '<b>' . $customer->Identity_No .'</b>'; ?></h5>
        </div>
        <div class="col-sm-12 text-center mt-3"><h5>First Name: <?php echo '<b>' . $customer->First_Name .'</b>'; ?>
            </h5></div><hr>
        <div class="col-sm-12 text-center mt-3"> <h5>Last Name: <?php echo '<b>' . $customer->Last_Name .'</b>'; ?>
            </h5></div><hr>
        <div class="col-sm-12 text-center mt-3"><h5>Mail: <?php echo '<b>' . $customer->Mail.'</b>'; ?>
            </h5></div><hr>
        <div class="col-sm-12 text-center mt-3"><h5>Phone: <?php echo '<b>' . $customer->Phone .'</b>'; ?>
            </h5></div>
    </div>

</div>