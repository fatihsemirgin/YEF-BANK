<!-- <?php var_dump($branch_temp); ?> -->

<div class="container">
    <h2 class="text-center mt-5">ADDING BRANCH</h2>
    <div class="row">
        <form class="col-sm-5 ml-auto mr-auto" action="<?php echo base_url("Admin/add_branch"); ?>" method="post">
            <div class="form-group form-control-user mt-5">
                <h5>City</h5>
                <input type="text" class="form-control form-control-lg" maxlength="50" name="city">
                <?php if (isset($form_error)) { ?>
                    <small class="input-form-error" style="color:red"> <?php echo form_error("city"); ?></small>
                <?php } ?>
            </div>
            <div class="form-group form-control-user mt-4">
                <h5>District</h5>
                <input type="text" class="form-control form-control-lg" maxlength="50" name="district">
                <?php if (isset($form_error)) { ?>
                    <small class="input-form-error" style="color:red"> <?php echo form_error("district"); ?></small>
                <?php } ?>
            </div>
            <div class="form-group form-control-user mt-4">
                <h5>Address</h5>
                <input type="text" class="form-control form-control-lg" maxlength="100" name="address">
                <?php if (isset($form_error)) { ?>
                    <small class="input-form-error" style="color:red"> <?php echo form_error("address"); ?></small>
                <?php } ?>
            </div>
            <div class="form-group form-control-user mt-4">
                <h5>Name</h5>
                <input type="text" class="form-control form-control-lg" maxlength="50" name="name">
                <?php if (isset($form_error)) { ?>
                    <small class="input-form-error" style="color:red"> <?php echo form_error("name"); ?></small>
                <?php } ?>
            </div>
            <hr>
            <div class="mt-5 text-center">
                <button class="btn btn-lg btn-success mr-5">ADD</button>
                <a href="<?php echo base_url("Admin/index"); ?>
                "><button class="btn btn-lg btn-primary" type="button">Main Page</button></a>
            </div>
        </form>
    </div>
</div>