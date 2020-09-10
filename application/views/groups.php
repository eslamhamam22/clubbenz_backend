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
             <div id="page-wrapper"style="background: white">
             	<div class="container-fluid">
                	<div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Manage Groups</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    		<a style="background: #2CABE3" data-toggle="modal" data-target="#add_group" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Group</a>
                    	</div>
                    </div>
                    <?php $this->load->view('message');?>
                     <table id="myTable" class="table table-striped">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="8%">Action</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>

                            </tr>
                        </thead>
                        <tbody>
						<?php $index = 1;foreach ($groups as $g) {
	?>
                            <tr>
                                <td>
                                    <div class="input-group-btn">
                                        <!-- <button type="button" class="btn waves-effect waves-light btn-inverse dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button> -->
                            	        <button aria-expanded="true" data-toggle="dropdown" class="btn dropdown-toggle waves-effect waves-light"><span class="caret"></span></button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a href="<?php echo base_url() ?>permissions/delete_group/<?php echo $g['id']; ?>">Delete</a></li>
                                            <li><a href="javascript:void(0)" onclick="updateGroup('<?php echo $g["id"] ?>', '<?php echo $g["name"] ?>', '<?php echo $g["description"] ?>', '<?php echo $g["check_permission"] ?>')">Edit</a></li>
                                            <li><?php if ($g["check_permission"] == "on") {?><li><a href="<?php echo base_url(); ?>permissions/group_base_permissions?group_id=<?php echo $g['id']; ?>">Manage Permissions</a></li><?php }?>
                                        </ul>
                                    </div>
                                </td>
                                <td><?php echo $index++ ?></td>
                                <td><?php echo $g['name'] ?></td>
                                <td><?php echo $g['description'] ?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
            <?php $this->load->view('common/common_footer')?>
            </div>
    	</div>
	</div>
<div id="edit_group" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Edit Group</h4>
            </div>
            <form name="frm" method="post" action="<?php echo base_url() ?>permissions/update_group">
            <input type="hidden" name="group_id" id="group_id" />
            <input type="hidden" name="user_id" id="user_id" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <label for="">Name</label>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" placeholder="Name" name="name" id="edit_group_name" readonly/>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <label>Description</label>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea class="form-control" name="description" id="edit_group_description"></textarea>
                        </div>
                    </div>
                    <br />

                    <!-- <div class="row">
                        <div class="col-md-6">
                            <label>Check Permission</label>
                        </div>
                        <div class="col-md-6">
                            <div class="switchery-demo m-b-30">
                                <input  type="checkbox" name="check_permission" id="check_permission" class="js-switch" data-color="#13dafe" data-switchery="true">
                            </div>
                        </div>
                    </div> -->

                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-info m-btn--pill waves-effect waves-light">Update</button>
                </div>
            </form>
        </div>
	</div>
</div>

<div id="add_group" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Add Group</h4>
            </div>
            <form name="frm" method="post" action="<?php echo base_url() ?>permissions/add_groups">
            <input name="user_id" type="hidden" id="user_id" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <label>Name</label>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" placeholder="Name" name="name" id="group_name" value="" />
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <label>Description</label>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <br />
                    <!-- <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <label>Redirect</label>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" placeholder="Redirect" name="redirect" id="redirect" value="" />
                        </div>
                    </div> -->

                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-info m-btn--pill-pill waves-effect waves-light" onClick="return checkGroup();">Submit</button>
                </div>
            </form>
        </div>
	</div>
</div>

   	<?php $this->load->view('common/common_script');?>
<script>
    function checkGroup(){
		var group = $('#group_name').val();
		if(group ==''){
			alert("Enter Group Name?");
			return false;
		}
    }

    function updateGroup(id,name,description,check_permission){
        $("#group_id").val(id);
		$("#edit_group_name").val(name);
		$("#edit_group_description").val(description);

			if(check_permission == "on"){
				$("#check_permission").prop('checked',false).trigger("click");
			}else{
				$("#check_permission").prop('checked',true).trigger("click");
			}
		$('#edit_group').modal('show');
    }

     var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });

</script>