
<?php $this->load->view('common/common_header');
$group_id = $this->ion_auth->get_users_groups()->result();
$permissions_groups = $this->ion_auth_model->get_all_permissions_by_groupids($group_id);
$check_admin_permission = 0;
// echo "<pre>";
// echo $group_id[0]->name;
// return;
foreach ($group_id as $g) {
	if ($g->name == 'admin') {
		$check_admin_permission++;
	}

}
$c_a = array();
foreach ($permissions_groups as $methodlist => $controllerlist) {
	foreach ($controllerlist as $modellist => $methods) {
		$c_a[] = $methods['controller'] . "/" . $methods['action'];
	}
}
?>
 <body class="fix-header">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="wrapper">
        <?php $this->load->view('common/top_nav');?>
        <?php $this->load->view('common/left_nav');?>
        <?php $this->load->view('message');?>

        <div id="page-wrapper">
<?php if (in_array('Dashboard/active', $c_a) || $group_id[0]->name == 'admin') {
	?>
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <select id="period" class="form-control">
                            <option value="">please select</option>
                            <option value="WEEK">WEEK</option>
                            <option value="MONTH">MONTH</option>
                        </select>
                    </div>

                    <div class="col-lg-9 " style="display:none;" id="form">

                        <form id="frm">
                            <div class="row">


                                <div class="col-md-4 both WEEK MONTH" id="start_date" style="display: none">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">from</label>
                                        <div class="col-md-9">
                                            <input type="text" autocomplete="off" id="datepicker1"  data-date-format='yyyy-mm-dd' name="date" class="form-control form_datetime">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 both MONTH" id="end_date" style="display:none">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">To</label>
                                        <div class="col-md-9">
                                             <input type="text" disabled  autocomplete="off" id="datepicker2"  data-date-format='yyyy-mm-dd' name="datef" class="form-control form_datetime ">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="col-md-9">
                                          <input type="button" id="btn" value="Sumbit" class="btn btn-info">
                                        </div>
                                    </div>
                                </div>
                                <div id="fresh" style="display:none ;width:30px;margin-left:-90px  " class="col-sm-6 col-md-4 col-lg-3"><i class="fa fa-spin fa-refresh"></i></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row" id="shops">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <div class="row row-in">
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-danger"><i class="ti-clipboard"></i></span>
                                        </li>
                                        <li class="col-last">

                                            <h3 class="counter text-right m-t-15"><?php echo $workshop; ?></h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Total Workshops</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-info"><i class="ti-wallet"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15"><?php echo $serviceshop ?></h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Total Service Shops</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-success"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15"><?php echo $partshop ?></h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Total Partshops</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-danger"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                            <?php $counter = 0?>
                                            <?php foreach ($carowners as $carowner) {?>
                                            <?php foreach ($rec as $re) {?>
                                            <?php if ($carowner->user_id == $re->id) {$counter++;}}}?>
                                            <?php echo $counter; ?></h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Total Car owners</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                             </div>
                        </div>
                    </div>

                    <div class="col-sm-12" >
                        <div class="white-box">
                            <div class="row row-in">

                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-info"><i class="ti-clipboard"></i></span>
                                        </li>
                                        <li class="col-last">

                                            <h3 class="counter text-right m-t-15"><?php echo $membership; ?></h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Total Memberships</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-success"><i class="ti-clipboard"></i></span>
                                        </li>
                                        <li class="col-last">

                                           <h3 class="counter text-right m-t-15"><?php echo $membership_users; ?></h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Total Expired Members</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-danger"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                                <?php echo count($active_parts); ?>
                                        </li>
                                        <li class="col-middle">
                                            <h4>active parts</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-info"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                                <?php echo count($in_active_parts); ?>
                                        </li>
                                        <li class="col-middle">
                                            <h4>active parts</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                             </div>
                        </div>
                    </div>

                    <div class="col-sm-12" >
                        <div class="white-box">
                            <div class="row row-in">

                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-success"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                            <?php $counter = 0?>
                                            <?php foreach ($favorites as $favorite) {?>
                                            <?php foreach ($parts as $partid) {?>
                                            <?php if ($favorite->part_id == $partid->id) {$counter++;}}}?>
                                            <?php echo $counter; ?>
                                            </h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Favorite</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-danger"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                                <?php echo count($booking_completed); ?>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Booking Completed</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-info"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                                <?php echo count($booking_pending); ?>

                                        </li>
                                        <li class="col-middle">
                                            <h4>Booking Pending</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-success"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                            <?php echo count($booking_rejected); ?>
                                            </h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Booking Rejected</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                             </div>
                        </div>
                    </div>

                    <div class="col-sm-12" >
                        <div class="white-box">
                            <div class="row row-in">
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-danger"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                                <?php echo count($reviews_pending); ?>
                                        </li>
                                        <li class="col-middle">
                                            <h4>User reviews pending</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-info"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                                <?php echo count($reviews_rejected); ?>

                                        </li>
                                        <li class="col-middle">
                                            <h4>User reviews rejected</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-success"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                            <?php echo count($reviews_approved); ?>
                                            </h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>User reviews approved</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-danger"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                                <?php echo count($active_ads); ?>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Active advertisement</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                             </div>
                        </div>
                    </div>

                    <div class="col-sm-12" >
                        <div class="white-box">
                            <div class="row row-in">

                                <div class="col-lg-4 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-info"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                                <?php echo count($provider_parts); ?>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Active advertisement</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-success"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                                <?php echo count($notification_provider); ?>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Provider notification</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-danger"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                                <?php echo count($notification_users); ?>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Notification</h4>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                             </div>
                        </div>
                    </div>

                </div>

                <div class="row col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-2">Chassis</label>
                        <div class="col-sm-9">
                            <select type="text" id=chassis name="chassis" class="form-control"  placeholder="chassis">
                                <option value="s">Select Chassis</option>
                                    <?php foreach ($chassis as $c) {if ($c->id != 24) {?>

                                        <option value="<?php echo $c->id ?>"><?php echo $c->chassis_num ?></option>
                                    <?php }}?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" style="margin-bottom:10px">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-md-2 control-label">Classes</label>
                        <div class="col-sm-9">
                            <select type="text" id=class name="class" class="form-control"  placeholder="chassis">
                                <option value="s">Select Class</option>
                                    <?php foreach ($classes as $c) {?>
                                        <option value="<?php echo $c->id ?>"><?php echo $c->name ?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row col-md-12">
                    <div class="row col-md-6" style="margin-bottom:10px">
                        <div>
                            <div class="white-box" id="chart_chassis">
                                <h3 class="box-title"> Users With Same chassis</h3>
                                <div>
                                    <canvas id="chart3" height="277" width="555" style="width: 555px; height: 277px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" style="margin-left: 20px">

                        <div>
                            <div class="white-box" id="chart_classes">
                                <h3 class="box-title"> User Car Classes</h3>
                                <div>
                                    <canvas id="chart4" height="277" width="555" style="width: 555px; height: 277px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
                <div class="row" style="width:1035px ">
                    <div class=" col-md-6">
                        <div class="white-box" id="chart_app_user">
                            <h3 class="box-title"> App Users</h3><h5>IOS: <span style="color: #FF7676; background-color: #FF7676; font-size: 15px;">--</span>&nbsp; Android: <span style="color: #B4C1D7; background-color: #B4C1D7; font-size: 15px;">--</span></h5>
                            <div>
                                <canvas id="chart2" height="277" width="555" style="width: 555px; height: 277px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else {?>
        <div class='noPermission' style="padding-top: 12%;text-align: center;">
        <h3> You dnt have permission for this section</h3>
        </div>
        <?php }?>
           <?php $this->load->view("common/common_footer")?>
    </div>
    <?php $this->load->view("common/common_script")?>
    <script type="text/javascript">
                $("#datepicker1").datepicker().datepicker("setDate", new Date());
    </script>
    <script type="text/javascript">
                $("#datepicker2").datepicker().datepicker("setDate", new Date());
    </script>
<?php if (in_array('Dashboard/active', $c_a) || $group_id[0]->name == 'admin') {?>
    <script type="text/javascript">
        $( document ).ready(function() {

    var ctx2 = document.getElementById("chart2").getContext("2d");
        var data2 = {
            labels: [0],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(255,118,118,0.8)",
                    strokeColor: "rgba(255,118,118,0.8)",
                    highlightFill: "rgba(255,118,118,1)",
                    highlightStroke: "rgba(255,118,118,1)",
                    data: [0]
                },
                {
                    label: "My Second dataset",
                    fillColor: "rgba(180,193,215,0.8)",
                    strokeColor: "rgba(180,193,215,0.8)",
                    highlightFill: "rgba(180,193,215,1)",
                    highlightStroke: "rgba(180,193,215,1)",
                    data:[0]
                }
            ]
        };

        var chart2 = new Chart(ctx2).Bar(data2, {
            scaleBeginAtZero : true,
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(0,0,0,.005)",
            scaleGridLineWidth : 0,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            barShowStroke : true,
            barStrokeWidth : 0,
            tooltipCornerRadius: 2,
            barDatasetSpacing : 3,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            responsive: true
        });

        var ctx2 = document.getElementById("chart3").getContext("2d");
        var data2 = {
            labels: [0],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(255,118,118,0.8)",
                    strokeColor: "rgba(255,118,118,0.8)",
                    highlightFill: "rgba(255,118,118,1)",
                    highlightStroke: "rgba(255,118,118,1)",
                    data: [0]
                },

            ]
        };

        var chart3 = new Chart(ctx2).Bar(data2, {
            scaleBeginAtZero : true,
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(0,0,0,.005)",
            scaleGridLineWidth : 0,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            barShowStroke : true,
            barStrokeWidth : 0,
            tooltipCornerRadius: 2,
            barDatasetSpacing : 3,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            responsive: true
        });
        var ctx2 = document.getElementById("chart4").getContext("2d");
        var data2 = {
            labels: [0],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(255,118,118,0.8)",
                    strokeColor: "rgba(255,118,118,0.8)",
                    highlightFill: "rgba(255,118,118,1)",
                    highlightStroke: "rgba(255,118,118,1)",
                    data: [0]
                },

            ]
        };

        var chart4 = new Chart(ctx2).Bar(data2, {
            scaleBeginAtZero : true,
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(0,0,0,.005)",
            scaleGridLineWidth : 0,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            barShowStroke : true,
            barStrokeWidth : 0,
            tooltipCornerRadius: 2,
            barDatasetSpacing : 3,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            responsive: true
        });


    });
    </script>
    <script type="text/javascript">
      $('#period').on('change', function() {
      //  alert( this.value ); // or $(this).val()
      if(this.value == "WEEK") {
        $('#form').show();
        $('#start_date').show();
        $('#end_date').show();
        $('#datepicker2').removeAttr("disabled");
      } else {
        $('#form').show();
        $('#start_date').show();
        $('#end_date').show();
         $('#datepicker2').removeAttr("disabled");
      }
    });
    </script>
    <script type="text/javascript">
       $(document).ready(function(){
            $('#chassis').change(function () {
                var period = $('#period').val();
                if(period != ""){
                    var chassis = $(this).val();
                    var period= $('#period').val();
                    if(period == 'WEEK'){
                        var datef =  $('#datepicker2').val();
                        var date =  $('#datepicker1').val();

                    }
                    if(period == 'MONTH'){
                        var datef =  $('#datepicker2').val();
                        var date =  $('#datepicker1').val();

                    }
                    $.ajax({
                        type: 'post',
                        url:'<?php echo base_url("dashboard/user_by_chassis") ?>',
                        data: {'chassis':chassis,'date':date,'datef':datef},
                        success: function (mydata) {
                                console.log(mydata);
                                $('#chart_chassis').html(mydata);
                        }
                    });
                }else{
                    alert("Please select chart schedule!");
                    $("#period").focus();
                }
            });

            $('#class').change(function () {

                var classes = $(this).val();
                var period= $('#period').val();
                if(period != ""){
                   if(period == 'WEEK'){
                        var datef =  $('#datepicker2').val();
                        var date =  $('#datepicker1').val();

                    }
                    if(period == 'MONTH'){
                        var datef =  $('#datepicker2').val();
                        var date =  $('#datepicker1').val();
                    }

                    $.ajax({
                        type: 'post',
                        url:'<?php echo base_url("dashboard/count_classes") ?>',
                        data: {'classes':classes,'date':date,'datef':datef},
                        success: function (mydata) {
                                console.log(mydata);
                                $('#chart_classes').html(mydata);
                        }
                    });
                }
                else{
                    alert("Please select chart schedule!");
                    $("#period").focus();
                }
            });

            $('#btn').click(function () {
                $('#fresh').show();
                var period= $('#period').val();
               if(period == 'WEEK'){
                    var datef =  $('#datepicker2').val();
                        var date =  $('#datepicker1').val();;
                    $.ajax({
                        type: 'post',
                        url:'<?php echo base_url("dashboard/app_user_couunt") ?>',
                        data: {'date':date,'datef':datef},
                        success: function (mydata) {
                                 $('#fresh').hide();
                                console.log(mydata);
                                $('#chart_app_user').html(mydata);
                        }
                    });

                }
                if(period == 'MONTH'){
                    var datef =  $('#datepicker2').val();
                    var date =  $('#datepicker1').val();
                    var oneDay = 24*60*60*1000;
                    var firstDate = new Date(date);
                    var secondDate = new Date(datef);
                    var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
                    if(diffDays<=365 && firstDate < secondDate){
                       $.ajax({
                        type: 'post',
                        url:'<?php echo base_url("dashboard/app_user_couunt") ?>',
                        data: {'date':date,'datef':datef},
                        success: function (mydata) {
                                 $('#fresh').hide();
                                console.log(mydata);
                                $('#chart_app_user').html(mydata);
                            }
                        });
                    }
                    else{
                        alert('Not More Then Year && From is Greater Then To!select again');
                         $('#fresh').hide();
                    }

                }

            });

            $('#btn').click(function () {
                $('#fresh').show();
                var period= $('#period').val();
               if(period == 'WEEK'){
                    var datef =  $('#datepicker2').val();
                        var date =  $('#datepicker1').val();
                    $.ajax({
                        type: 'post',
                        url:'<?php echo base_url("dashboard/shop_count") ?>',
                        data: {'date':date,'datef':datef},
                        success: function (mydata) {
                                 $('#fresh').hide();
                                console.log(mydata);
                                $('#shops').html(mydata);
                        }
                    });

                }
                if(period == 'MONTH'){
                    var datef =  $('#datepicker2').val();
                    var date =  $('#datepicker1').val();
                    var oneDay = 24*60*60*1000;
                    var firstDate = new Date(date);
                    var secondDate = new Date(datef);
                    var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
                    if(diffDays<=365 && firstDate < secondDate){
                       $.ajax({
                        type: 'post',
                        url:'<?php echo base_url("dashboard/shop_count") ?>',
                        data: {'date':date,'datef':datef},
                        success: function (mydata) {
                                 $('#fresh').hide();
                                console.log(mydata);
                                $('#shops').html(mydata);
                            }
                        });
                    }
                    else{
                        alert('Not More Then Year && From is Greater Then To!select again');
                         $('#fresh').hide();
                    }

                }

            });
        });
    </script>
     <?php }?>
</body>
</html>