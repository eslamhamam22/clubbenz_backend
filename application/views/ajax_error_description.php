<div class="row margin-top" style="margin-left: 30px;margin-bottom: 20px;width: 1091px">
    <p>
    <div class="col-md-6" style="margin-top: 40px">
        <div class="form-group">
            <div class="col-md-9">
                <label class="control-label">Enter Solution Text En</label>
                <textarea style="height: 60px" class="form-control" rows="4" name="descriptions[]" ><?php  if(!empty($this->input->post('description'))){ echo $this->input->post('description');}?></textarea>
                <label class="control-label">Enter Solution Text Ar</label>
                <textarea style="height: 60px" class="form-control" rows="4" name="description_arabics[]"><?php  if(!empty($this->input->post('description_arabic'))){ echo $this->input->post('description_arabic');}?></textarea>

            </div>
        </div>
    </div>
    <div class="col-md-6 margin-top">
        <div align="center" class="col-sm-9">
            <div>
                <label  for="inputEmail3" class="control-label">Upload Solution Image</label>
            </div>
            <input type="file" class= "form-control btn btn-default" name="pic[]" size="20" multiple="multiple" />
            <input type="hidden" name="error_id[]" value="">
            <span style="color: red; font-size: 12px;">Image Size should be 960X720</span>
        </div>
    </div>
    </p>
</div>
<div  style="margin-top: 80px;width: 80%;height: 1px;background-color: grey;margin:auto">
</div>   