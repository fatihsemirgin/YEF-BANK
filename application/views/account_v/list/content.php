<div class="col-md-12">
        <h4 class="m-b-lg">
        My Accounts
        </h4>
    </div>
<div class="col-md-12">
				<div class="widget p-lg">
                <?php if(empty($account_info)){ ?>
                    <div class="alert alert-info text-center">
                        <p>There is no account. <a href="<?php echo base_url("");?>">Click</a> to add.</p>
                    </div>
                <?php } else {?>
					<table class="table table-hover table-striped table-bordered content-container">
                        <thead>
                            <th>ID</th>
                            <th>IBAN</th>
                            <th>Branch ID</th>
                            <th>Balance</th>
                            <th>Branch</th>
                            <th>Operation</th>
                        </thead>
                        <tbody>
                            <?php foreach($account_info as $account){ ?>
                                <td><?php echo $account->Account_ID;?></td>
                                <td><?php echo $account->IBAN;?></td>
                                <td><?php echo $account->Branch_ID;?></td>
                                <td><?php echo number_format($account->Balance,2);?></td>
                                <td><?php echo $account->Name;?></td>
                                <td class="text-center"> 
                                    <button data-url="<?php echo base_url("account_op/delete_account/$account->Account_ID"); ?>" class="btn btn-sm btn-danger btn-outline remove-btn"><i class="fa fa-trash"></i> Close</button>
                                </td>
                               
                            </tr>
                            <?php }?>
                        </tbody>
					</table>
                <?php } ?>
				</div><!-- .widget -->
			</div><!-- END column -->