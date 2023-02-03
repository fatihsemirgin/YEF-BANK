<div class="container">
    <div class="row">
        <!-- <div>
            <ol class="breadcrumb hidden-xs">
                <li>-> Accounts</li>
                <li>/Transfer</li>
            </ol>
        </div> -->
        <!-- <?php print_r($accounts); ?> -->


        <div class="form-group col-sm-12">
            <h2 class="text-center mt-5 mb-4">Transfer Between My Accounts</h2>
            <hr>
            <h4>Recipient Account</h4>
            <div class="row">
                <?php foreach ($accounts as $account) {; ?>
                    <div class="card col-sm-4 shadow " style="width: 18rem;">
                        <div class="card-body text-center ">
                            <h5 class="card-title"><?php echo $account->City; ?>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $account->District; ?></h6>
                            <p class="card-text">Balance: <?php echo $account->Balance; ?> $
                            </p>
                            <button onclick="showTransfer(<?php echo $account->Account_ID; ?>,'sender','recipient')" class="btn btn-primary" id="<?php echo $account->Account_ID; ?>" type="button">Select</button>
                        </div>
                    </div>
                <?php }; ?>
            </div>
            <hr>
            <div id="sender">
            </div><br>
            <div id="amount" class="text-center">
            </div>
            <div class="text-center mt-5">
                <a href="<?php echo base_url(); ?>"><button class="btn btn-primary">Main Page</button></a>
            </div>
            <!-- <div id="result"></div> -->

        </div>

    </div>
</div>