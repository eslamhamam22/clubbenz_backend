
<?php $this->load->view('common/common_header');?>
<body class="fix-header">

<div id="wrapper" style="background: white">
    <?php $this->load->view('common/top_nav');?>
    <?php $this->load->view('common/left_nav');?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Import File</h4>
                </div>

            </div>
            <?php $this->load->view("message");?>

            <section class="showcase">
                <div class="container">
                    <div class="pb-2 mt-4 mb-2 border-bottom">
                        <h2>Import Data From Excel or CSV file in Cars</h2>
                    </div>

                    <?php if (form_error('fileURL')) {?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php print form_error('fileURL');?>
                        </div>
                    <?php }?>


                    <form action="<?php print site_url();?>partshopsheet/upload" class="excel-upl" id="excel-upl" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <div class="row padall" style="margin-top: 50px">
                            <div class="col-lg-6 order-lg-1">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>

                                <input type="file" class="custom-file-input" id="validatedCustomFile" name="fileURL">
                            </div>

                        </div>
                        <div class="col-lg-6 order-lg-2" style="margin-top: 40px">
                            <button type="submit" name="import" class="float-right btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </section>


        </div>
        <?php $this->load->view('common/common_footer')?>
    </div>
</div>
<?php $this->load->view("common/common_script")?>


</body>

</html>













