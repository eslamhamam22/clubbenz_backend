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
                                    <h4 class="page-title">Manage Parts Categories</h4>
                                </div>
                                 <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('partcategory/add_parts_categories') ?>"  class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Parts</a>
                                </div>
                            </div>


                            <?php $this->load->view('message');?>
                            <div class="row el-element-overlay m-b-40">
                                <?php
foreach ($rec as $us) {
	?>
                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                        <div class="white-box">
                                            <div class="el-card-item">
                                                <div style="height:200px " class="el-card-avatar el-overlay-1"> <image style="width:200px;margin: auto;" src="<?php echo base_url('upload/') . $us->image; ?>">
                                                    <div class="el-overlay">
                                                        <ul class="el-info">
                                                            <li><a  title="Edit" class="btn default btn-outline image-popup-vertical-fit" href="<?php echo base_url('partcategory/edit_parts_categories') ?>/<?php echo $us->id; ?>" ><i class="icon-pencil"></i></a></li>
                                                            <li><a class="btn default btn-outline" title="Delete" href="<?php echo base_url('partcategory/part_del/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="icon-trash"></i></a></li>
                                                        </ul>
                                                    </div>

                                                </div>
                                                <div class="el-card-content">
                                                    <h3 class="box-title"><?php echo $us->name; ?></h3> <small><?php echo $us->arabic_name; ?></small> <p><?php echo $us->id; ?></p>
                                                    <br> </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
;?>
                            </div>





                            <!-- <table id="myTable" class="table table-striped">

                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>image</th>
                                        <th> Name</th>
                                        <th>Arabic Name</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
foreach ($rec as $us) {
	?>
                                    <tr>
                                        <td><?php echo $us->sorting; ?></td>
                                        <td><image style="width:200px;" src="<?php echo base_url('upload/') . $us->image; ?>"></td>
                                        <td><?php echo $us->name; ?></td>
                                        <td><?php echo $us->arabic_name; ?></td>
                                         <td><a href="<?php echo base_url('carmodel/part_del/') ?><?php echo $us->id; ?>"><input type="button" name = "button"class='btn btn-danger' value="Delete"></a>
                                                <a href="<?php echo base_url('carmodel/edit_parts_categories') ?>/<?php echo $us->id; ?>"><input type="button" class='btn btn-warning' value="Edit"></a>
                                         </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                             </table>     -->
                    <?php $this->load->view("common/common_footer")?>
                </div>
            </div>
        </div>

        <?php $this->load->view('common/common_script');?>
        <!-- <script>
            $(document).ready( function () {
                $('#myTable').DataTable({"bSort": false});
            });
        </script>  -->

    </body>

</html>
