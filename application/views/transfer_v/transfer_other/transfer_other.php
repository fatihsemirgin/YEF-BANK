<!-- <?php echo '<pre>';
 print_r($accounts); echo '</pre>' ; ?> -->

<div class="container">
    <h2 class="text-center mt-5 mb-4">Transfer Other Accounts</h2>
    <hr>
    <h4>Recipient Account IBAN</h4>
    <div class="row">

        <div class="form-group col-sm-7 mt-4">
            <label for="inputPassword2" class="sr-only">Password</label>
            <input type="text" maxlength="26" minlength="26" class="form-control" id="input_iban" placeholder="TR" required>
        </div>
        <div class="ml-3 col-sm-4 mt-4">
            <button onclick="amount_other()" type="button" class="btn btn-primary mb-2">Confirm IBAN</button>
        </div>
    </div>
    <!-- <hr> -->
    <!-- <h4>Sender Account</h4> -->
    <div id="recipient_other" class="row mt-4">   
        <!-- <?php foreach ($accounts as $account) {; ?>
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
        <?php }; ?> -->
    </div>
    <div id="send_part"></div>
    <div class="text-center" id="amount_part"></div>
    <div class="text-center mt-4 mb-3">
        <a href="<?php echo base_url(); ?>"><button class="btn btn-primary">Main Page</button></a>
    </div>
</div>