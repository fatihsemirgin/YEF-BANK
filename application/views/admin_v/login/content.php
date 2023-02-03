<div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>
                                    </div>
                                    <form action ="<?php echo base_url("admin/admin_login");?>" method="post">
                                        <div class="form-group">
                                            <input name="username" class="form-control form-control-user" placeholder="Username">
                                                <?php if(isset($form_error)){ ?>
                                                    <small class="input-form-error" style="color:red"> <?php echo form_error("username"); ?></small>
                                                <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                                                <?php if(isset($form_error)){ ?>
                                                    <small class="input-form-error" style="color:red"> <?php echo form_error("password"); ?></small>
                                                <?php } ?>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Login</button>

                                        <div class="text-center">
                                            <a class="small" href="<?php echo base_url();?>">Back to Main Menu.</a>
                                        </div>
                                    
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>