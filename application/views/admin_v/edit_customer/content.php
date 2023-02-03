<!-- <?php var_dump($user_temp); ?> -->

<div class="container">
    <h2 class="text-center mt-5">Changing Contact Informations</h2>
    <div class="row">
        <form class="col-sm-5 ml-auto mr-auto" action="<?php echo base_url("Admin/edit_customer/$user_temp->Customer_ID"); ?>" method="post">
            <div class="form-group form-control-user mt-5">
                <h5>Name</h5>
                <input type="text" class="form-control form-control-lg" maxlength="50" name="first_name" placeholder=" <?php echo $user_temp->First_Name; ?>
                 ">
                <?php if (isset($form_error)) { ?>
                    <small class="input-form-error" style="color:red"> <?php echo form_error("first_name"); ?></small>
                <?php } ?>
            </div>
            <div class="form-group form-control-user mt-4">
                <h5>Last Name</h5>
                <input type="text" class="form-control form-control-lg" maxlength="50" name="last_name" placeholder=" <?php echo $user_temp->Last_Name; ?>
                 ">
                <?php if (isset($form_error)) { ?>
                    <small class="input-form-error" style="color:red"> <?php echo form_error("last_name"); ?></small>
                <?php } ?>
            </div>
            <hr>
            <div class="mt-5 text-center">
                <button class="btn btn-lg btn-success mr-5">Confirm</button>
                <a href="<?php echo base_url("Admin/index"); ?>
                "><button class="btn btn-lg btn-primary" type="button">Main Page</button></a>
            </div>
        </form>
    </div>
</div>