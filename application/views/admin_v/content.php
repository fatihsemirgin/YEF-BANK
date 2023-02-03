<div class="container my-5">
    <h2 class="text-center mb-4">ADMIN CONTROL PANEL</h2>
    <h3 class="mb-3">Tables</h3>
    <div class="row">
        <div class="col-3">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active text-center" id="list-account-list" data-toggle="list" href="#list-account" role="tab" aria-controls="home">Account</a>
                <a class="list-group-item list-group-item-action text-center" id="list-branch-list" data-toggle="list" href="#list-branch" role="tab" aria-controls="profile">Branch</a>
                <a class="list-group-item list-group-item-action text-center" id="list-card-list" data-toggle="list" href="#list-card" role="tab" aria-controls="messages">Card</a>
                <a class="list-group-item list-group-item-action text-center" id="list-customer-list" data-toggle="list" href="#list-customer" role="tab" aria-controls="settings">Customer</a>
                <a class="list-group-item list-group-item-action text-center" id="list-log-ins-list" data-toggle="list" href="#list-log-ins" role="tab" aria-controls="settings">Log-ins</a>
                <a class="list-group-item list-group-item-action text-center" id="list-transaction-list" data-toggle="list" href="#list-transaction" role="tab" aria-controls="settings">Transaction</a>
                <a class="list-group-item list-group-item-action text-center" id="list-account-changes-list" data-toggle="list" href="#list-account-changes" role="tab" aria-controls="settings">Account Changes</a>
                <a class="list-group-item list-group-item-action text-center" id="list-account-logs-list" data-toggle="list" href="#list-account-logs" role="tab" aria-controls="settings">Account Money Changes</a>
                <a class="list-group-item list-group-item-action text-center" id="list-customer-changes-list" data-toggle="list" href="#list-customer-changes" role="tab" aria-controls="settings">Customer Changes</a>
            </div>
            <div class="mt-3 text-center">
                <a href="<?php echo base_url("admin/logout") ?>"><button class="btn btn-primary">Log-out</button></a>
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="nav-tabContent">
                <!--                // ACCOUNT TABLE-->
                <div class="tab-pane fade show active table-responsive" id="list-account" role="tabpanel" aria-labelledby="list-account-list">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">IBAN</th>
                                <th scope="col">Account_ID</th>
                                <th scope="col">Identity_No</th>
                                <th scope="col">Branch_ID</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($account_table)) { ?>
                                <?php foreach ($account_table as $row) { ?>
                                    <tr>
                                        <td><?php echo $row['IBAN']; ?></td>
                                        <td><?php echo $row['Account_ID']; ?></td>
                                        <td><?php echo $row['Identity_No']; ?></td>
                                        <td><?php echo $row['Branch_ID']; ?></td>
                                        <td><?php echo $row['Balance']; ?></td>
                                        <td class="text-center">
                                            <button data-url="<?php echo base_url("admin/delete_account/{$row['Account_ID']}"); ?>" class="btn btn-sm btn-danger btn-outline remove-btn"><i class="fa fa-trash"></i> Close</button>
                                        </td>

                                    </tr>



                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!--                // BRANCH TABLE-->
                <div class="tab-pane fade table-responsive" id="list-branch" role="tabpanel" aria-labelledby="list-branch-list">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Branch_ID</th>
                                <th scope="col">City</th>
                                <th scope="col">District</th>
                                <th scope="col">Address</th>
                                <th scope="col">Name</th>
                                <th scope="col">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($branch_table)) { ?>
                                <?php foreach ($branch_table as $row) { ?>
                                    <tr>
                                        <td><?php echo $row['Branch_ID']; ?></td>
                                        <td><?php echo $row['City']; ?></td>
                                        <td><?php echo $row['District']; ?></td>
                                        <td><?php echo $row['Address']; ?></td>
                                        <td><?php echo $row['Name']; ?></td>
                                        <td class="text-center"><a class="text-center" href="<?php echo base_url("admin/edit_branch_page/{$row['Branch_ID']}"); ?>">
                                                <button data-url="" class="btn btn-sm btn-info btn-outline mr-2" style="width:80px"><i class="fa fa-edit"></i> Edit</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="text-center" >
                        <a href="<?php echo base_url("admin/add_branch_page") ; ?>">
                            <button type="button" data-url="" class="btn btn-primary btn-outline" style="width:80px"><i class="fa fa-plus"></i></button>
                        </a>
                        
                    </div>
                    
                </div>
                <!--                // CARD TABLE-->
                <div class="tab-pane fade table-responsive" id="list-card" role="tabpanel" aria-labelledby="list-card-list">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Card_No</th>
                                <th scope="col">Account_ID</th>
                                <th scope="col">Exp_Date</th>
                                <th scope="col">CVV</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($card_table)) {
                                foreach ($card_table as $row) {
                                    echo "<tr>
                                        <td>{$row['Card_No']}</td>
                                        <td>{$row['Account_ID']}</td>
                                        <td>{$row['Exp_Date']}</td>
                                        <td>{$row['CVV']}</td>
                                      </tr>";
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
                <!--                // CUSTOMER TABLE-->
                <div class="tab-pane fade table-responsive table-responsive" id="list-customer" role="tabpanel" aria-labelledby="list-customer-list">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Customer_ID</th>
                                <th scope="col">Identity_No</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Phone</th>
                                <th scope="col">First_Name</th>
                                <th scope="col">Last_Name</th>
                                <th scope="col">Password</th>
                                <th scope="col">Wrong_Login</th>
                                <th scope="col">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($customer_table)) { ?>
                                <?php foreach ($customer_table as $row) { ?>
                                    <tr>
                                        <td><?php echo $row['Customer_ID']; ?></td>
                                        <td><?php echo $row['Identity_No']; ?></td>
                                        <td><?php echo $row['Mail']; ?></td>
                                        <td><?php echo $row['Phone']; ?></td>
                                        <td><?php echo $row['First_Name']; ?></td>
                                        <td><?php echo $row['Last_Name']; ?></td>
                                        <td><?php echo $row['Password']; ?></td>
                                        <td><?php echo $row['Wrong_Login']; ?></td>
                                        <td class="text-center d-flex">
                                            <a href="<?php echo base_url("admin/edit_customer_page/{$row['Customer_ID']}"); ?>">
                                                <button data-url="" class="btn btn-sm btn-info btn-outline mr-2" style="width:80px"><i class="fa fa-edit"></i> Edit</button>
                                            </a>
                                            <button data-url="<?php echo base_url("admin/delete_customer/{$row['Customer_ID']}"); ?>" class="btn btn-sm btn-danger btn-outline remove-btn " style="width:80px"><i class="fa fa-trash"></i> Delete</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!--                // LOG-INS TABLE-->
                <div class="tab-pane fade table-responsive" id="list-log-ins" role="tabpanel" aria-labelledby="list-log-ins-list">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Identity_No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($log_ins_table)) { ?>
                                <?php foreach ($log_ins_table as $row) { ?>
                                    <?php $type = $row['Type']; ?>
                                    <tr>
                                        <td><?php echo $row['Identity_No']; ?></td>
                                        <td><?php echo $row['Date']; ?></td>

                                        <?php if ($type == -1) { ?>
                                            <td><?php echo "Quit"; ?></td>
                                        <?php } else { ?>
                                            <td><?php echo ($type == "1") ? "Successful" : "Failed"; ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!--                // TRANSACTION TABLE-->
                <div class="tab-pane fade table-responsive" id="list-transaction" role="tabpanel" aria-labelledby="list-transaction-list">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Customer_ID</th>
                                <th scope="col">T_ID</th>
                                <th scope="col">IBAN_sender</th>
                                <th scope="col">IBAN_recipient</th>
                                <th scope="col">Sender</th>
                                <th scope="col">Recipient</th>
                                <th scope="col">Done</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($transaction_table)) {
                                foreach ($transaction_table as $row) {
                                    echo "<tr>
                                        <td>{$row['Customer_ID']}</td>
                                        <td>{$row['T_ID']}</td>
                                        <td>{$row['IBAN_sender']}</td>
                                        <td>{$row['IBAN_recipient']}</td>
                                        <td>{$row['Sender']}</td>
                                        <td>{$row['Recipient']}</td>
                                        <td>{$row['Done']}</td>
                                      </tr>";
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
                <!--                ACCOUNT_CHANGES_LOGS TABLE-->
                <div class="tab-pane fade table-responsive" id="list-account-changes" role="tabpanel" aria-labelledby="list-account-changes-list">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Event</th>
                                <th scope="col">IBAN</th>
                                <th scope="col">Account_ID</th>
                                <th scope="col">Identity_No</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($account_changes_logs)) {
                                foreach ($account_changes_logs as $row) {
                                    echo "<tr>
                                        <td>{$row['Date']}</td>
                                        <td>{$row['Event']}</td>
                                        <td>{$row['IBAN']}</td>
                                        <td>{$row['Account_ID']}</td>
                                        <td>{$row['Identity_No']}</td>
                                      </tr>";
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
                <!--                ACCOUNT_LOGS TABLE-->
                <div class="tab-pane fade table-responsive" id="list-account-logs" role="tabpanel" aria-labelledby="list-account-logs-list">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Last_Name</th>
                                <th scope="col">Event</th>
                                <th scope="col">Account_ID</th>
                                <th scope="col">Old_Balance</th>
                                <th scope="col">New_Balance</th>
                                <th scope="col">Sender</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($account_logs)) {
                                foreach ($account_logs as $row) {
                                    echo "<tr>
                                        <td>{$row['Date']}</td>
                                        <td>{$row['Last_Name']}</td>
                                        <td>{$row['Event']}</td>
                                        <td>{$row['Account_ID']}</td>
                                        <td>{$row['Old_Balance']}</td>
                                        <td>{$row['New_Balance']}</td>
                                        <td>{$row['Sender']}</td>
                                      </tr>";
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
                <!--                CUSTOMER_CHANGES_LOG TABLE-->
                <div class="tab-pane fade table-responsive" id="list-customer-changes" role="tabpanel" aria-labelledby="list-customer-changes-list">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Identity_No</th>
                                <th scope="col">Event</th>
                                <th scope="col">Old</th>
                                <th scope="col">New</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($customer_changes_log)) {
                                foreach ($customer_changes_log as $row) {
                                    echo "<tr>
                                        <td>{$row['Date']}</td>
                                        <td>{$row['Identity_No']}</td>
                                        <td>{$row['Event']}</td>
                                        <td>{$row['Old']}</td>
                                        <td>{$row['New']}</td>
                                      </tr>";
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>