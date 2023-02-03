<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("includes/head") ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
        <?php
                if(isset($error_add)){
                    if ($error_add == 0) {
                        echo "<script>
                        Swal.fire({
                            icon : 'success',
                            title: '<i>SUCCESSFUL UPDATING</i>', 
                            text: 'The Customer Has Been Successfully Updated',  
                        });
                        </script>";
                    }
                }
                
                ; ?>

            <!-- Main Content -->
            <div id="content">
                <!-- Top-bar -->

                <!-- End of Top-bar -->

                <!-- Begin Page Content -->
                <?php $this->load->view("{$view_folder}/{$sub_view_folder}/content") ?>

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