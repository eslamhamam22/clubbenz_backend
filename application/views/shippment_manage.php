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
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Shippment Manage</h4>
                        </div>

                    </div>
                    <?php $this->load->view('message');?>
                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>shippment/shippment_update">

                        <?php
foreach ($rec as $us) {?>
                        <input type="hidden" name="id" value="<?php echo $us['id']; ?>">

                        <div class="form-body"style="background: white;padding-bottom:30px">

                            <div class="form-body"style="background: white;padding-bottom:30px">
                                <h3 class="box-title" style="padding-top:30px;text-align:center;"></h3>

                                <div class="row margin-top">
                                    <div class="">
                                        <?php if (!empty($us['file'])) {?>
                                        <div align="center" class="" style="">
                                            <i class="fa fa-file"></i>
                                            <a class="aclick" href=" <?php echo base_url('upload/') . $us['file']; ?>" title="Show" rel="bookmark" target="_blank"> Show </a>
                                        </div>
                                    <?php }?>
                                        <h4 style="padding: 50px"><b>Upload File PDF</b></h4>
                                        <div align="center" class="" style="">
                                            <div align="center" style="padding: 30px">
                                                <input style="width: 400px" type="file" class= "form-control btn btn-default" name="file" size="20"  />

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <?php }?>

                                <div class="row margin-top">

                                    <div align="center" class="margin-top" style="">
                                        <input style="width: 200px; height: 50px;font-size: 20px     ; background-color: forestgreen " type="submit" name="submit" class="btn btn-primary" value="submit">
                                    </div>
                                </div>
                    </form>


                        </div>
                    </form>

                </div>
               <?php $this->load->view('common/common_footer')?>
            </div>
        </div>
         <?php $this->load->view('common/common_script')?>

    </body>

</html>

