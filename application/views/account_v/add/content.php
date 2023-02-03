<div class="row ml-3 justify-content-center">
    <div class="col-md-12 mb-5">
        <h4 class="m-b-lg text-center">
        ADD NEW ACCOUNT
        </h4>
    </div>
	<div class="col-md-3">
    <div class="widget">
					<div class="widget-body">
						<form action="<?php echo base_url("account_op/new_account")?>" method="post">		

							<div class="form-group">
								<label for="control-demo-6" class="">Branch Name</label>
								<div id="control-demo-6" class="">
									<select class="form-control" name="branch_id">
										<?php foreach ($branch_info as $branch) { ?>
											
											<option value="<?php echo $branch->Branch_ID; ?>"><?php echo $branch->Name; ?></option>
											
										<?php } ?>
										
									</select>
								</div>
							</div>		

							<button type="submit" class="btn btn-primary btn-md btn-outline">Add Account</button>
                            <a href="<?php echo base_url()?>" class="btn btn-md btn-danger btn-outline">Cancel</a>
						</form>
					</div><!-- .widget-body -->
				</div><!-- .widget -->
	</div><!-- END column -->
</div>