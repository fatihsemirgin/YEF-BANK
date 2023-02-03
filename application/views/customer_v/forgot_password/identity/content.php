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
                                        <h4 style="font-size: 20px">Please Enter Your Identity Number</h4>
                                    </div>
                                    <form action ="<?php echo base_url("customer_op/send_code");?>" method="post">
                                        <div class="form-group d-block justify-content-center">
                                            <div style="width:75%;margin:0 auto 0 auto">
                                                <input style="margin-bottom:5px" name="identity" class="form-control form-control-user" placeholder="Identity No">
                                                <?php if(isset($form_error)){ ?>
                                                    <small class="input-form-error" style="color:red"> <?php echo form_error("identity"); ?></small>
                                                <?php } else if (isset($not_found)) { ?>
                                                    
                                                    <small class="input-form-error" style="color:red"> <b>There is no such customer has entered identity no.</b></small>
                                                <?php } ?>
                                            </div>

                                                
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-lg">Send Code</button>
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