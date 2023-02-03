<?php $user = get_active_user(); ?>

<div class="container">
    <h2 class="text-center">Changing Contact Informations</h2>
    <div class="row">
        <form class="col-sm-5 ml-auto mr-auto" action="<?php echo base_url("Profile_set/reset_contact_info"); ?>" method="post">

            <div class="form-group form-control-user mt-5">
                <h5>Phone Number</h5>
                <input type="number" class="form-control form-control-lg" name="phone" placeholder="+9<?php echo $user->Phone; ?>
                 ">
                <?php if (isset($form_error)) { ?>
                    <small class="input-form-error" style="color:red"> <?php echo form_error("phone"); ?></small>
                <?php } ?>
            </div>
            <div class="form-group form-control-user mt-4">
                <h5>E-Mail</h5>
                <input type="email" class="form-control form-control-lg" name="email" placeholder=" <?php echo $user->Mail; ?>
                 ">
                <?php if (isset($form_error)) { ?>
                    <small class="input-form-error" style="color:red"> <?php echo form_error("email"); ?></small>
                <?php } ?>
            </div>
            <hr>
            <div class="mt-5 text-center">
                <button class="btn btn-lg btn-success">Confirm</button>
            </div>
        </form>
    </div>
</div>