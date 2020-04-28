
<div class="container-fluid">
<div class="row"  style="padding-top: 80px">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label col-md-3">Parts Group</label>
            <div class="col-md-9">
                <select name="parts_group[]"  class="form-control" >
                    <option value="0">Select Part Group</option>
                    <?php foreach($service as $r){?>
                    <option value="<?php echo $r->id;?>" ><?php echo $r->name?></option>
                    <?php } ?>
                </select> <span class="help-block"> </span> 
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label col-md-3">Services</label>
            <div class="col-md-9">
                <select name="services[]" class="form-control" >
                    <option value="0">Select Services </option>
                    <?php foreach($parts as $a){?>
                    <option value="<?php echo $a->id?>"><?php echo $a->name?></option>
                    <?php } ?>
                </select> <span class="help-block">  </span> 
            </div>
        </div>
    </div>                    
</div>
</div>
