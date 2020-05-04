<?php $this->load->view('common/common_header');?>

    <body class="fix-header">

        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>

        <div id="wrapper" style="background: white">

            <?php $this->load->view('common/top_nav');?>

            <?php $this->load->view('common/left_nav');?>
                 <div id="page-wrapper" style="background: white">
                    <div class="container-fluid">
                        <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Catalog Manage </h4>
                        </div>
                    </div>

                        <?php $this->load->view('message');?>
                        <div style="overflow: auto">
                            <table id="myTable" class="table table-striped" >
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($rec as $us) {?>
                                    <tr>
                                        <td><?php echo $us->name ?></td>

                                        <td><?php $status = $us->status;if ($status == 1) {?>
                                        <a href="<?php echo base_url('catalog/update_status?sid=') ?><?php echo $us->id; ?>&sval=<?php echo $status; ?> " class="btn btn-small btn-danger">Hidden</a>
                                        <?php } else {?>
                                             <a href="<?php echo base_url('catalog/update_status?sid=') ?><?php echo $us->id; ?>&sval=<?php echo $status; ?> " class="btn btn-small btn-success">Show </a>
                                        <?php }?> </td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>

                        </div>
                        <?php $this->load->view("common/common_footer")?>
                </div>
            </div>
        </div>
        <?php $this->load->view("common/common_script")?>
        <script>
            $(document).ready( function () {
                $('#myTable').DataTable({"bSort": false});
            });
        </script>
    </body>

</html>




