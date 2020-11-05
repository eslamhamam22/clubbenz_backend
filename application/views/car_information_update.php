<?php $this->load->view('common/common_header');
foreach ($models as $m) {
	if ($rec->model_id == $m->id) {
		echo $m->image;
		$carImage = base_url() . 'upload/' . $m->image;
	}
}
?>
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
                    <h4 class="page-title">Update Car Information</h4>
                </div>
                <div class="mainimagee" name="frsm" >
                    <?php if (isset($carImage)) {?>
                <img src="<?php echo $carImage; ?>"  id='model_image'/>
            <?php } else {echo "No Image Found";}?>
                </div>
            </div>

            <div class="col-md-4 col-lg-3" >
                <div >

                </div>
            </div>
            <?php $this->load->view('message');?>
            <form name="frm" method="post" action="<?php echo base_url('cars/edit_car/' . $rec->id) ?>" >

                <div class="form-body"style="background: white;padding-bottom:30px">
                    <!--  <h3 class="box-title" style="padding-top:30px;text-align:center;">Add Car</h3> -->

                   <div style="margin-left: 50px">
                    <div class="row" style="padding-top: 20px">
                        <div class="col-md-6" style="width: 28%">
                                <div class="" style="padding-left: 15px ; padding-right: 15px">
                                    <label class=" ">Model Name</label>

                                    <?php $model_arr = explode(",", $rec->model_id);?>
                                            <select id="classes_select" type="text" name="model_id[]" class="form-control js-example-tokenizer3" multiple >
                                                <option value="">Select Option</option>

                            <?php foreach ($models as $model) {
	?>

                                <?php
if (in_array($model->id, $model_arr)) {
		echo '<option value="' . $model->id . '" selected>' . $model->name . '</option>';
	} else {
		echo '<option value="' . $model->id . '">' . $model->name . '</option>';
	}

	?>
                                                    <?php }?>
                                            </select>



                                    <span class="help-block"> </span>
                                    <script type="text/javascript">
                                        document.frm.model_id.value = '<?php echo $rec->model_id ?>';

                                    </script>
                                </div>

                        </div>
                        <div class="col-md-6" style="width: 28%">
                            <div class="form-group">
                                <?php
$chassis_numb = $this->car->get_chassis_by_id($rec->chassis);
?>

                                <label class="">Chassis</label>

                                <?php $chassis_arr = explode(",", $rec->chassis);?>
                                <select  required type="text" name="chassis[]" id="chassis_select" class="form-control js-example-tokenizer" multiple>
                                <option value="<?php foreach ($chassis_number as $c) {echo $c->id . ',';}?>">All</option>
                                <?php foreach ($chassis_number as $cn) {
	?>

                                <?php if (in_array($cn->id, $chassis_arr)) {
		echo '<option value="' . $cn->id . '" selected>' . $cn->chassis_num . '</option>';
	} else {
		echo '<option value="' . $cn->id . '">' . $cn->chassis_num . '</option>';
	}

	?>
                                <?php }?>
                                </select>


                                <span class="help-block"></span>
                                  </div>

                        </div>
                        <div class="col-md-6" style="float: right ; width: 38%">

                            <div class="form-group">
                                <div class="col-md-9">
                                    <label class=" ">Enter Vin Prefix</label>
                                    <input type="text" name="vin_prefix" class="form-control" value="<?php echo $rec->vin_prefix ?>"> </div>
                            </div>
                        </div>

                    </div>
                    <div class="row margin-top">
                        <div class="col-md-6" style="width: 28%">

                            <div class="" style="padding-left: 15px ; padding-right: 15px">

                                    <label class="">Enter Start Year</label>
                                    <input type="text" name="year_start" class="form-control" value="<?php echo $rec->model_year_start ?>"> </div>

                        </div>
                        <div class="col-md-6" style="width: 28%">

                            <div class="form-group">
                                    <label class="">Model Years End</label>

                                    <input type="text" name="year_end" class="form-control" value="<?php echo $rec->model_year_end ?>">
                            </div>
                        </div>


                        <div class="col-md-6" style="float: right ; width: 38%">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label class="">Fuel Type</label>

                                    <select name="fuel_type" class="form-control">
                                        <option>Select Fuel Type</option>
                                        <?php foreach ($fuel_name as $fl) {?>
                                            <option value="<?php echo $fl->id; ?>"><?php echo $fl->name ?></option>
                                        <?php }?>
                                    </select>
                                    <script type="text/javascript">
                                        document.frm.fuel_type.value = '<?php echo $rec->fuel_type ?>';
                                    </script>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row margin-top">
                        <div class="col-md-6" style="width: 28%">

                            <div class="" style="padding-left: 15px ; padding-right: 15px">
                                    <label class="">Enter Model</label>

                                    <input type="text" name="model" class="form-control" value="<?php echo $rec->model ?>">
                            </div>
                        </div>

                        <div class="col-md-6" style="width: 62%">
                            <div class="form-group">
                                    <label class="">Model Text</label>
                                    <input type="text" name="model_text" class="form-control" value="<?php echo $rec->model_text ?>">
                            </div>
                        </div>



                    </div>
                   </div>
                    <div align="center">
                        <div align="center" style="width: 95% ; height: 2px; background-color: grey">
                        </div>

                    </div>

                    <div style="margin-left: 50px">
                    <div class="row margin-top">
                        <div class="col-md-6" style="width: 200px" >
                        <label class="">Motor Code</label>
                                    <input type="text" name="motor_code" style="height: 120px ; width: 150px ; text-align: center" class="form-control" value="<?php echo $rec->motor_code ?>">

                        </div>
                        <div class="col-md-6" style="width: 200px">
                        <label class="">Displacement</label>
                                    <input type="text" name="displacement" style="height: 120px ; width: 150px ; text-align: center" class="form-control"  value="<?php echo $rec->displacement ?>">


                        </div>
                        <div class="col-md-6" style="width: 200px">

                                    <label class="">Horse Power</label>

                                    <input type="text" name="horse_power" style="height: 120px ; width: 150px ; text-align: center" class="form-control" value="<?php echo $rec->horse_power ?>">


                        </div>
                        <div class="col-md-6" style="width: 200px">


                                <label class="">Oil Capacity Litres</label>

                                <input type="text" name="oil_capacity_letter" style="height: 120px ; width: 150px ; text-align: center" class="form-control" value="<?php echo $rec->oil_capacity_liter ?>"> </div>
                        <div class="col-md-6" style="width: 200px">


                                <label class="">Top Speed</label>
                                    <input type="text" name="top_speed" style="height: 120px ; width: 150px ; text-align: center" class="form-control" value="<?php echo $rec->top_speed ?>">

                        </div>

                    </div>
                    <div class="row margin-top">

                        <div class="col-md-6" style="width: 200px">

                                    <label class="">Fuel Per 100 Km</label>
                                    <input type="text" name="fuel_hundred" style="height: 120px ; width: 150px ; text-align: center" class="form-control"value="<?php echo $rec->fuel_per_hundred_km ?>">

                        </div>
                        <div class="col-md-6" style="width: 200px" >
                            <label class="">Accel. 0–100 km/h</label>
                            <input type="text" name="ac_sec" style="height: 120px ; width: 150px ; text-align: center" class="form-control"  value="<?php echo $rec->acceleretion_second ?>">
                        </div>
                        <div class="col-md-6" style="width: 200px">

                            <label class="">Tank capacity</label>
                            <input type="text" style="height: 120px ; width: 150px ; text-align: center" name="wheeles" class="form-control" value="<?php echo $rec->wheels ?>">
                        </div>
                        <div class="col-md-6" style="width: 200px">

                               <label class="">Tires</label>
                                    <input type="text" style="height: 120px ; width: 150px ; text-align: center" name="tyres" class="form-control" value="<?php echo $rec->tires ?>">
                        </div>
                        <div class="col-md-6" style="width: 200px">

                                <label class="">Text</label>
                                    <input type="text" style="height: 120px ; width: 150px ; text-align: center" name="text" class="form-control" value="<?php echo $rec->text1 ?>">
                        </div>
                    </div>
                    </div>

                    <div class="row margin-top">


                        <div align="center" style="margin-top: 30px">
                            <input type="submit" name="submit" class="btn btn-primary" value="Update">
                        </div>

<!--                        <div class="col-md-6">-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label class="control-label col-md-3">Text One</label>-->
<!--                                <div class="col-md-9">-->
<!--                                    <input type="text" name="text_one" class="form-control" value="--><?php //echo $rec->text2?><!--"> </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <input type="hidden" name="id"  value="<?php echo $rec->id ?>">
                    </div>

                </div>
            </form>


        </div>
        <?php $this->load->view("common/common_footer");?>
    </div>
</div>
<?php $this->load->view("common/common_script");?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $(".js-example-tokenizer").select2({
                    tags: true,
                    placeholder: "Please select option",
                    tokenSeparators: [',', ' ']
                });
                 $(".js-example-tokenizer2").select2({
                    placeholder: "Please select option",
                    tokenSeparators: [',', ' ']
                });
                 $(".js-example-tokenizer3").select2({
                    placeholder: "Please select option",
                    tokenSeparators: [',', ' ']
                });
                 var chassis_number= [];
                <?php foreach ($chassis_number as $c) {?>
                chassis_number.push({
                    id: <?php echo $c->id; ?>,
                    chassis_num: "<?php echo $c->chassis_num; ?>",
                    model_id: "<?php echo $c->model_id; ?>"
                })
                <?php }?>
                $('#classes_select').change( function () {
                    var value = $(this).val() + ''
                    console.log(value)
                    var valueArr= value.split(',');
                    var availableChassis= []
                    if(!$(this).val()){
                        availableChassis= chassis_number.slice()
                    }else{
                        availableChassis= chassis_number.filter(function (ch) {
                            return valueArr.indexOf(ch.model_id) != -1
                        })
                    }
                    var prevValue= $('#chassis_select').val();
                    $('#chassis_select').empty();
                    // $('#chassis_select').append('<option value="">Select Option</option>');
                    $('#chassis_select').append('<option value="all">All</option>');
                    availableChassis.forEach( function(ch){
                        console.log(ch.id)
                        $('#chassis_select').append('<option value="'+ch.id+'">'+ch.chassis_num+'</option>');
                    })
                    $('#chassis_select').val(prevValue || '')
                });
            });
        </script>
<script>
function updateCar(){
    // alert(1);
    var mode = document.getElementById("model_id").value;

    // alert("<?php echo $count_user_x ?> ");
}
</script>
</body>
<style>
.mainimagee img {
    width: 100%;
    padding: 13px;
}
.mainimagee {
    ;
    max-width: 500px;
    margin: auto;
}</style>
</html>

