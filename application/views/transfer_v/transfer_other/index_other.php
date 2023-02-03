<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("includes/head") ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php $this->load->view("includes/sidebar") ?>    

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Top-bar -->

                <!-- End of Top-bar -->
                <?php $this->load->view("includes/top-bar") ?>
                <!-- Begin Page Content -->
                <?php $this->load->view("{$view_folder}/{$sub_view_folder}/transfer_other") ?>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <?php $this->load->view("includes/footer") ?>
            <!-- Footer -->

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- JavaScript -->
    <?php $this->load->view("includes/include_script") ?>

</body>

</html>