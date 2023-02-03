<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("includes/head") ?>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view("includes/sidebar") ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Top-bar -->
            <?php $this->load->view("includes/top-bar") ?>
            <!-- End of Top-bar -->

            <!-- Begin Page Content -->
            <?php $this->load->view("{$view_folder_name}/new_content") ?>

            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
    </div>
    <!-- Footer -->
    <?php $this->load->view("includes/footer") ?>
    <!-- End of Footer -->
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- JavaScript -->
<?php $this->load->view("includes/include_script") ?>


</body>

</html>
