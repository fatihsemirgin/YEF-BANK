<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!--                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
                        <div class="col">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Reset Your Password</h1>
                                    <h4 style="font-size: 20px">Please enter your new password.</h4>
                                </div>
                                <form action ="<?php echo base_url("customer_op/reset_password");?>" method="post">
                                    <div class="form-group d-flex flex-column align-items-center">
                                        <input style="width: 75%" type="password" name="new_password" class="form-control form-control-user" placeholder="New password">
                                        <?php if(isset($form_error)){ ?>
<!--                                            <small class="input-form-error d-block text-left" style="color:red"> </small>-->
                                            <div class="invalid-feedback d-block w-75">

                                                <small class="input-form-error" style="color:red;font-size:13px"> <b> <?php echo form_error("new_password"); ?></b> </small>

                                               
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group d-flex flex-column align-items-center">
                                        <input style="width: 75%" type="password" name="password_again" class="form-control form-control-user" placeholder="Password again">
                                        <?php if(isset($form_error)){ ?>
<!--                                            <small class="input-form-error" style="color:red; width: 75%;"> </small>-->
                                            <div class="invalid-feedback d-block w-75">

                                                <small class="input-form-error" style="color:red;font-size:13px"> <b><?php echo form_error("password_again"); ?> </b> </small>

                                                
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">Reset Password</button>
                                    </div>
                                </form>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url();?>">Back to Main Menu.</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>