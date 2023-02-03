<div class="container-fluid">
    <div class="row">
        <?php if ($this->session->userdata("currency")) { ?>
            <!--            --><?php //echo "<script>alert('SESSION USED')</script>"
                                ?>

            <?php foreach ($this->session->userdata("currency") as $val) { ?>
                <div class="col-xl-2 col-md-6 col-sm-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">


                                <div class="col mr-2">
                                    <?php if ($val[2] > 0) { ?>
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo "{$val[0]}"; ?></div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format("{$val[1]}", 4) ?></div>
                                        <span class="badge badge-success" style="font-size: 15px"><?php echo number_format($val[2], 2) . "%"; ?></span>
                                    <?php } else { ?>
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo "{$val[0]}"; ?></div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format("{$val[1]}", 4) ?></div>
                                        <span class="badge badge-danger" style="font-size: 15px"><?php echo number_format($val[2], 2) . "%"; ?></span>
                                    <?php } ?>
                                </div>

                                <div class="col-auto">
                                    <i class="fas fa-bitcoin fa-2x text-gray-300"></i>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <?php echo "<script>alert('API USED')</script>" ?>

            <?php if (isset($currency)) {
                foreach ($currency as $val) { ?>
                    <div class="col-xl-2 col-md-6 col-sm-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">


                                    <div class="col mr-2">
                                        <?php if ($val[2] > 0) { ?>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo "{$val[0]}"; ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format("{$val[1]}", 4) ?></div>
                                            <span class="badge badge-success" style="font-size: 15px"><?php echo number_format($val[2], 2) . "%"; ?></span>
                                        <?php } else { ?>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo "{$val[0]}"; ?></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format("{$val[1]}", 4) ?></div>
                                            <span class="badge badge-danger" style="font-size: 15px"><?php echo number_format($val[2], 2) . "%"; ?></span>
                                        <?php } ?>
                                    </div>

                                    <div class="col-auto">
                                        <i class="fas fa-bitcoin fa-2x text-gray-300"></i>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
    <!--<<<<<<< Updated upstream-->
    <div class="row">
        <!-- <?php print_r($branches); ?> -->

        <div class="col-xl-6" style="padding: 0 0.75rem 0 0.75rem;">
            <div class="card shadow h-100 p-3">

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="currency_1">Converted currency</label>
                            <select class="form-control" id="currency_1">
                                <option>TRY</option>
                                <?php if (isset($currency)) {
                                    foreach ($currency as $val) {
                                        echo "<option>$val[0]</option>";
                                    }
                                } else if ($this->session->userdata("currency")) {
                                    foreach ($this->session->userdata("currency") as $val) {
                                        echo "<option>$val[0]</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="currency_2">Currency to be converted</label>
                            <select class="form-control" id="currency_2">
                                <option>TRY</option>
                                <?php if (isset($currency)) {
                                    foreach ($currency as $val) {
                                        echo "<option>$val[0]</option>";
                                    }
                                } else if ($this->session->userdata("currency")) {
                                    foreach ($this->session->userdata("currency") as $val) {
                                        echo "<option>$val[0]</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" id="amount" placeholder="Amount">
                </div>
                <div id="result" class="d-none">
                    <span id="txt-converted"></span>
                    <span id="txt-toBeConverted"></span>
                </div>
                <div class="text-center mt-2">
                    <button id="btn-convert" class="btn btn-primary btn-lg">Convert</button>
                </div>
            </div>
        </div>
        <div class="col-xl-6 ">

            <div class="card  shadow h-100 py-2">
                <div class="card-body">
                    <h3>The Nearest YEF BANK</h3>
                    <hr>
                    <form>
                        <select name="cities" class="form-control text-center" onchange="showBranch(this.value,'districts','retrieve_data')">
                            <option value="">Select City:</option>
                            <?php foreach ($branches as $branch) {; ?>
                                <option value=<?php echo $branch->Branch_ID; ?>><?php echo $branch->City; ?>
                                </option>

                            <?php }; ?>

                        </select>
                    </form>
                    <div class="mt-5 d-none" id="districts">


                    </div>
                    <div class="mt-4 d-none" id="info">

                    </div>
                </div>
            </div>
        </div>
    </div>