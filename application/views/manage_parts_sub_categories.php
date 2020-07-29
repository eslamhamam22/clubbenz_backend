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
                                    <h4 class="page-title">Manage Parts SUB Categories</h4>
                                </div>
                                 <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('partsubcategory/add_parts_sub_categories') ?>"  class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Parts</a>
                                </div>
                            </div>
                            <?php $this->load->view('message');?>
                            <div class="row el-element-overlay m-b-40 margin-top">
                                <?php
foreach ($partcat as $cat) {
	$sub_cat = $cat->id;
	$subcate = $this->partsubcategory->get_subcategory($sub_cat);
	if ($subcate) {
		?>

                                    <div class="row col-md-12"> <h3><?php echo $cat->name ?></h3></div>
                                <?php foreach ($subcate as $subcat) {
			?>

                        <div style="height:300px" class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                            <div class="white-box">
                                <div class="el-card-item">
                                    <div style="height:200px " class="el-card-avatar el-overlay-1">
                                        <img style="width:200px;padding-top: 10px;width: 150px ;margin: auto;" src="<?php echo base_url('upload/') . $subcat['image']; ?>">
                                        <div class="el-overlay">
                                            <ul class="el-info">
                                            <li>
<a class="btn default btn-outline image-popup-vertical-fit" title="Edit" href="<?php echo base_url('partsubcategory/edit_parts_sub_categories') ?>/<?php echo $subcat['id']; ?>" ><i class="icon-pencil"></i></a></li>
                                                <li><a class="btn default btn-outline" title="Delete" href="<?php echo base_url('partsubcategory/part_sub_categories_del/') ?><?php echo $subcat['id']; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="icon-trash"></i></a></li>

                                                <?php $status = $subcat['status'];if ($status == 1) {?>
    <a href="<?php echo base_url('partsubcategory/update_status?sid=') ?><?php echo $subcat['id']; ?>&sval=<?php echo $status; ?> " class="btn btn-success">Active</a>
                                                <?php } else {?>
                                                     <a href="<?php echo base_url('partsubcategory/update_status?sid=') ?><?php echo $subcat['id']; ?>&sval=<?php echo $status; ?> " class="btn btn-danger">in Active</a>
                                                <?php }?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="el-card-content">
                                        <h3 class="box-title"><?php echo $subcat['name']; ?></h3> <small><?php echo $subcat['arabic_name']; ?></small> <h5> ID : <?php echo $subcat['id']; ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }}?>

              <?php }?>
            </div>
        <?php $this->load->view('common/common_footer');?>
    </div>
</div>
</div>
<?php $this->load->view('common/common_script');?>

</body>

</html>
