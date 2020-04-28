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
                                    <h4 class="page-title">Parts Photos Listing </h4>
                                </div>
                                 <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url(); ?>part_photos/add_part_photos/<?php echo $part_id; ?>"  class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Part Photo</a>
                                </div>
                            </div>


                            <?php $this->load->view('message');?>
                            <div class="row el-element-overlay m-b-40">
                                <?php
foreach ($rec as $us) {
	?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="white-box">
                                            <div class="el-card-item">
                                                <div style="height:200px;" class="el-card-avatar el-overlay-1"> <image style="width:200px;margin:auto;" src="<?php echo base_url('upload/') . $us['photo_name']; ?>">
                                                    <div class="el-overlay">
                                                        <ul class="el-info">
                                                            <li><a class="btn default btn-outline" title="Delete" href="<?php echo base_url('part_photos/del_part_photos/') ?><?php echo $us['id'] . '/' . $part_id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="icon-trash"></i></a></li>
                                                            <li><a class="text-inverse pr-2" title="Edit"  data-original-title="Edit" href="javascript:void(0)"  data-toggle="modal" data-target="#edit_role" onclick="update('<?php echo $us['id']; ?>','<?php echo $us['is_default']; ?>','<?php echo $part_id; ?>')"><i class="ti-marker-alt"></i></a></li>
                                                        </ul>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php }
;?>
                            </div>
                            <div id="edit_role" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel1">Photo Selection Update</h4>
                                </div>
                                <form name="frm" method="post"type="foo.MyAction" scope="request" action="<?php echo base_url('/part_photos/update_part_photos') ?>">
                                <input type="hidden" name="user_id" id="user_id" />
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <label>Select Option</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-12">

                                                    <select id="status"  name="is_default" class="form-control">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                    </select><br>

                                            </div>
                                        </div>

                                            <input type="hidden" name="id" id="id">
                                            <input type="hidden" name="part_id" id="part_id">

                                    </div>
                                    <div class="modal-footer">
                                       <button type="submit"  class="btn btn-info m-btn--pill waves-effect waves-light">Update</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>


                    <?php $this->load->view("common/common_footer")?>
                </div>
            </div>
        </div>

        <?php $this->load->view('common/common_script');?>
       <script type="text/javascript">
            function update(uid,status,part_id){

                $("#id").val(uid);
                $("#status").val(status);
                $("#part_id").val(part_id);
               }

        </script>


    </body>

</html>
