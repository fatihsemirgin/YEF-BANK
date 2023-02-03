<div class="container">
    <h2 class="text-center">Transaction History</h2>
    <table class="mt-5 table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">IBAN Sender</th>
                <th scope="col">IBAN Recipient</th>
                <th scope="col">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($transactions as $transaction) {; ?>
                <tr>
                    <th scope="row"> <?php echo $i; ?>
                    </th>
                    <td> <?php echo $transaction->Date; ?></td>
                    <td> <?php echo $transaction->IBAN_sender; ?></td>
                    <td> <?php echo $transaction->IBAN_recipient; ?></td>
                    <td> <?php echo $transaction->Amount.'$'; ?></td>
                </tr>
                <?php $i++ ; ?>
                
            <?php }; ?>


        </tbody>
    </table>
</div>