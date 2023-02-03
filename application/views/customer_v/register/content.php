<div class="container">

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form action ="<?php echo base_url("customer_op/do_register");?>" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control" placeholder="First Name" name="first_name">
                                    <?php if(isset($form_error)){ ?>
                                        <small class="input-form-error" style="color:red"> <?php echo form_error("first_name"); ?></small>
                                    <?php } ?>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                                <?php if(isset($form_error)){ ?>
                                    <small class="input-form-error" style="color:red"> <?php echo form_error("last_name"); ?></small>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address" name="email">
                            <?php if(isset($form_error)){ ?>
                                <small class="input-form-error" style="color:red"> <?php echo form_error("email"); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <?php if(isset($form_error)){ ?>
                                    <small class="input-form-error" style="color:red"> <?php echo form_error("password"); ?></small>
                                <?php } ?>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" placeholder="Repeat Password" name="re_password">
                                <?php if(isset($form_error)){ ?>
                                    <small class="input-form-error" style="color:red"> <?php echo form_error("re_password"); ?></small>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input  class="form-control" placeholder="Identity No" name= "identity">
                                <?php if(isset($form_error)){ ?>
                                    <small class="input-form-error" style="color:red"> <?php echo form_error("identity"); ?></small>
                                <?php } ?>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="Phone" name="phone">
                                <?php if(isset($form_error)){ ?>
                                    <small class="input-form-error" style="color:red"> <?php echo form_error("phone"); ?></small>
                                <?php } ?>
                            </div>
                        </div>
                       
                        <button type="submit" class="btn btn-primary btn-user btn-block">Create an account ! </button>
                        
                    </form>
                    <hr>
<!--                    <div class="text-center">-->
<!--                        <a class="small" href="forgot-password.html">Forgot Password?</a>-->
<!--                    </div>-->
                    <div class="text-center">
                        <a class="small" href="<?php echo base_url("customer_op/login_form");?>">Already have an account? Login!</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="<?php echo base_url();?>">Back to Main Menu.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>