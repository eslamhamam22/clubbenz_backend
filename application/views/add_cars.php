<?php $this->load->view('common/common_header');?>
    <body class="fix-header">

        <div id="wrapper" style="background: white">
            <?php $this->load->view('common/top_nav');?>
            <?php $this->load->view('common/left_nav');?>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Add Car</h4>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-3" >
                        <div >

                        </div>
                    </div>
                    <?php $this->load->view('message');?>
                    <form method="post">

                        <div class="form-body"style="background: white;padding-bottom:30px">
                            <!--  <h3 class="box-title" style="padding-top:30px;text-align:center;">Add Car</h3> -->

                            <div style="margin-left: 50px">
                                <div class="row" style="padding-top: 20px">
                                    <div class="col-md-6" style="width: 28%">
                                        <div class="" style="padding-left: 15px ; padding-right: 15px">
                                            <label class=" ">Model Name</label>
                                            <select name="model_id" class="form-control">
                                                <option>Select Model</option>
                                                <?php foreach ($year as $yr) {?>
                                                    <?php echo '<option value="' . $yr->id . '">' . $yr->name . '</option>'; ?>
                                                    <!-- <option><?php echo $yr->name ?></option> -->
                                                <?php }?>
                                            </select> <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="width: 28%">
                                        <div class="form-group">

                                            <label class="">Chassis</label>
                                            <select name="chassis" class="form-control" style="width: 200px;">
                                                <option>Select Chassis</option>
                                                <?php foreach ($chassis_number as $cn) {?>
                                                    <?php echo '<option value="' . $cn->id . '">' . $cn->chassis_num . '</option>'; ?>

                                                <?php }?>
                                            </select> <span class="help-block"></span>


                                        </div>

                                    </div>
                                    <div class="col-md-6" style="float: right ; width: 38%">

                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class=" ">Enter Vin Prefix</label>
                                                <input type="text" name="vin_prefix" class="form-control" placeholder="Vin Prefix" value="<?php echo $this->input->post("vin_prefix") ?>"> </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row margin-top">
                                    <div class="col-md-6" style="width: 28%">

                                        <div class="" style="padding-left: 15px ; padding-right: 15px">

                                            <label class="">Enter Start Year</label>
                                            <input type="text" name="year_start" class="form-control" placeholder="Model Year Start" value="<?php echo $this->input->post("year_start") ?>"> </div>

                                    </div>
                                    <div class="col-md-6" style="width: 28%">

                                        <div class="form-group">
                                            <label class="">Model Years End</label>

                                            <input type="text" name="year_end" class="form-control" placeholder="Model Year End" value="<?php echo $this->input->post("year_end") ?>">
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

                                            <input type="text" name="model" class="form-control" placeholder="Model" value="<?php echo $this->input->post("model_id") ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6" style="width: 62%">
                                        <div class="form-group">
                                            <label class="">Model Text</label>
                                            <input type="text" name="model_text" class="form-control" placeholder="Model Text" value="<?php echo $this->input->post("model_text") ?>">
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
                                        <input type="text" name="motor_code" style="height: 120px ; width: 150px ; text-align: center" class="form-control" placeholder="Motor Code" value="<?php echo $this->input->post("motor_code") ?>">

                                    </div>
                                    <div class="col-md-6" style="width: 200px">
                                    <label class="">Displacement</label>
                                        <input type="text" name="displacement" style="height: 120px ; width: 150px ; text-align: center" class="form-control"  placeholder="displacement" value="<?php echo $this->input->post("displacement") ?>">


                                    </div>
                                    <div class="col-md-6" style="width: 200px">

                                        <label class="">Horse Power</label>

                                        <input type="text" name="horse_power" style="height: 120px ; width: 150px ; text-align: center" class="form-control" placeholder="Horse power" value="<?php echo $this->input->post("horse_power") ?>">


                                    </div>
                                    <div class="col-md-6" style="width: 200px">


                                        <label class="">Oil Capacity Litres</label>

                                        <input type="text" name="oil_capacity_letter" style="height: 120px ; width: 150px ; text-align: center" class="form-control" placeholder="Oil Capacity " value="<?php echo $this->input->post("oil_capacity_letter") ?>"> </div>
                                    <div class="col-md-6" style="width: 200px">


                                        <label class="">Top Speed</label>
                                        <input type="text" name="top_speed" style="height: 120px ; width: 150px ; text-align: center" class="form-control" placeholder="Top Speed" value="<?php echo $this->input->post("top_speed") ?>">

                                    </div>

                                </div>
                                <div class="row margin-top">

                                    <div class="col-md-6" style="width: 200px">

                                        <label class="">Fuel Per 100 Km</label>
                                        <input type="text" name="fuel_hundred" style="height: 120px ; width: 150px ; text-align: center" class="form-control" placeholder="Fuel Per 100 Km" value="<?php echo $this->input->post("fuel_hundred") ?>">

                                    </div>
                                    <div class="col-md-6" style="width: 200px" >
                                        <label class="">Accel. 0–100 km/h</label>
                                        <input type="text" name="ac_sec" style="height: 120px ; width: 150px ; text-align: center" class="form-control"  placeholder="Acceleration/Sec" value="<?php echo $this->input->post("ac_sec") ?>">
                                    </div>
                                    <div class="col-md-6" style="width: 200px">

                                        <label class="">Wheeles</label>
                                        <input type="text" style="height: 120px ; width: 150px ; text-align: center" name="wheeles" class="form-control"  placeholder="Wheeles" value="<?php echo $this->input->post("wheeles") ?>">
                                    </div>
                                    <div class="col-md-6" style="width: 200px">

                                        <label class="">Tires</label>
                                        <input type="text" style="height: 120px ; width: 150px ; text-align: center" name="tyres" class="form-control" placeholder="Tires" value="<?php echo $this->input->post("tires") ?>">
                                    </div>
                                    <div class="col-md-6" style="width: 200px">

                                        <label class="">Text</label>
                                        <input type="text" style="height: 120px ; width: 150px ; text-align: center" name="text" class="form-control" placeholder="Text" value="<?php echo $this->input->post("text") ?>">
                                    </div>
                                </div>
                            </div>

                                <div align="center" class="margin-top" >
                                    <input type="submit" name="submit" class="btn btn-primary" value="submit">
                                </div>

                        </div>

                    </form>

                </div>
                <?php $this->load->view("common/common_footer")?>
            </div>
        </div>
       <?php $this->load->view("common/common_script")?>


    </body>

</html>

