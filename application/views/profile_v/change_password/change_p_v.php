<div class="container">
    <h2 class="text-center">Changing Password</h2>
    <div class="row">
        <form class="col-sm-5 ml-auto mr-auto" action="<?php echo base_url("Profile_set/reset_password"); ?>" method="post">
            <div class="form-group form-control-user mt-5">
                <input type="password" class="form-control form-control-lg" name="available" placeholder="Available Password">
                <?php if (isset($form_error)) { ?>
                    <small class="input-form-error" style="color:red"> <?php echo form_error("available"); ?></small>
                <?php } ?>
            </div>
            <div class="form-group form-control-user mt-4">
                <input type="password" class="form-control form-control-lg" name="new" placeholder="New Password">
                <?php if (isset($form_error)) { ?>
                    <small class="input-form-error" style="color:red"> <?php echo form_error("new"); ?></small>
                <?php } ?>
            </div>
            <div class="form-group form-control-user mt-4">
                <input type="password" class="form-control form-control-lg" name="repeat" placeholder="Repeat Password">
                <?php if (isset($form_error)) { ?>
                    <small class="input-form-error" style="color:red"> <?php echo form_error("repeat"); ?></small>
                <?php } ?>
            </div>
            <div class="mt-5 text-center">
                <button class="btn btn-lg btn-success">Confirm</button>
            </div>
        </form>
    </div>
</div>