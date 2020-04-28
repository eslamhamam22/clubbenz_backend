<?php $this->load->view('common/common_header');?>
<script src="<?php echo base_url()?>assets/js/validator/validator.js"></script>
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
            <div class="container-fluid" >
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Push Notification</h4>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3" >
                    
                </div>
                <div class="col-md-6" style="background: white">
                    <div class="white-box">
                        <?php $this->load->view('message');?>
                        <form class="form-horizontal" method="post" action="<?php echo base_url();?>push_notification/send_push_notification">

                        <div align="center" style ="width :100%; margin : 20px">
                            
                            <label for="" class="">User Details</label>
            
                        </div>


                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Classes</label>
                                <div class="col-sm-9">
                                     <select name="class_id" id="class" class="form-control">
                                        <option value="">Select classes</option>
                                        <?php foreach($class as $c){?>
                                        <option value="<?php echo $c->id;?>" ><?php echo $c->name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Fuel Type</label>
                                <div class="col-sm-9">
                                     <select name="fuel_id" id="fuel" class="form-control">
                                        <option value="">Select Fuel Type</option>
                                        <?php foreach($fuel as $f){?>
                                        <option value="<?php echo $f->id;?>" ><?php echo $f->name?></option>
                                        <?php } ?>
                                     </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Year</label>
                                <div class="col-sm-9">
                                     <select name="year_id" id="year" class="form-control">
                                        <option value="">Select year</option>
                                        <?php foreach($year as $y){?>
                                        <option value="<?php echo $y->id;?>" ><?php echo $y->name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Chassis</label>
                                <div class="col-sm-9">
                                     <select name="chassis" id="chassis" class="form-control">
                                        <option value="">Select Chassis</option>
                                        <?php foreach($chassis as $ca){?>
                                        <option value="<?php echo $ca->id; ?>" ><?php echo $ca->chassis_num; ?></option>
                                        <?php } ?>
                                     </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Cars</label>
                                <div class="col-sm-9">

                                     <select name="car_vin_prefix" id="car" class="form-control">
                                        <option value="">Cars List</option>
                                        <option value="" ></option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" class="form-control" required >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Message</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="4" id="text" name="text" required /></textarea>
                                </div>
                            </div>
                            <div align="center" style ="width :100%; margin : 20px">
                            
                                <label for="" class="">Landing Page Details</label>
                
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Type</label>
                                <div class="col-sm-9">
                                     <select name="type_name" id="type" class="form-control">
                                        <option value="">Select Shop Type</option>
                                        <option value="partsshop">Parts Shop</option>
                                        <option value="workshop">Work Shop</option>
                                        <option value="serviceshop">Service Shop</option>
                                     </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Shops</label>
                                <div class="col-sm-9">
                                     <select name="shop_id" id="shops" class="form-control" >
                                        <option value="">Shops List</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-3 col-sm-9">
                                   <button type="submit" class="btn btn-info waves-effect waves-light m-t-10" id="submit">Send</button>
                                </div>
                            </div>


                            

                        </form>
                    </div>
                </div>
            </div>
                <?php $this->load->view('common/common_footer');?>

        </div>
         <?php $this->load->view('common/common_script');?>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $('#chassis').change(function () {
                    var class_id = $('#class').val();
                    var fuel_id = $('#fuel').val();
                    var year_id = $('#year').val();
                    var chassis_id = $('#chassis').val();
                    if(class_id > 0 && fuel_id > 0 && year_id > 0 && chassis_id > 0){
                        $.ajax({
                            type: 'post',
                            url:'<?php echo base_url("push_notification/cars")?>',
                            data: {'class_id':class_id,'fuel_id':fuel_id,'year_id':year_id, 'chassis_id':chassis_id},
                            success: function (mydata) {
                                    console.log(mydata);
                                    $('#car').html(mydata);
                            }
                        });
                    }
                });


                $('#type').change(function () {
                    var type = $('#type').val();
                    if(type != ""){
                        $.ajax({
                            type: 'post',
                            url:'<?php echo base_url("push_notification/shops")?>',
                            data: {'type':type},
                            success: function (mydata) {
                                    console.log(mydata);
                                    $('#shops').html(mydata);
                            }
                        });
                    }
                    else{
                        alert('must select type');
                    } 
                }); 
            });


            $('form')
                .on('blur', 'input[required], input.optional, select.required', validator.checkField)
                .on('change', 'select.required', validator.checkField)
                .on('keypress', 'input[required][pattern]', validator.keypress);

            $('.multi.required')
                .on('keyup blur', 'input', function () {
                    validator.checkField.apply($(this).siblings().last()[0]);
                });

        $('form').submit(function (e) {
            e.preventDefault();
            var text = $('#text').val();
            var submit = true;
            if(text !=""){
                submit = true;
            }else{
                submit = false;
            }
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }
            if (submit)
                this.submit();
            return false;
        });

        </script>
    </body>
</html>
