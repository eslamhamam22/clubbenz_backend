
<div class="form-group delete_col">
<label for="inputEmail3" class="col-sm-3 control-label"> Details</label>
<div class="col-sm-9">
<input type="text" name="details[]" class="form-control" id="details" placeholder="Details" required>
</div>
<div align="center" style="margin-top:12px; ">
     <input style="width: 150px; height: 40px; margin-top:20px; background-color: forestgreen " type="button" name="delete" class="remove_field btn btn-primary" value="Delete">
    <div>
        <h6><b>Add other Solution</b> </h6>
    </div>
</div>
</div>

<script type="text/javascript">
	// var x = 1; //initlal text box count
$(document).ready(function() {
	$('.remove_field').on("click", function(e){ //user click on remove field
	e.preventDefault();
	 $('.delete_col').remove();
	});
});
</script>