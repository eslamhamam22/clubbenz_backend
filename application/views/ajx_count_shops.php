
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
                                            <?php echo $carowners ?></h3>
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

                        <div class="white-box">
                            <div class="row row-in">

                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-info"><i class="ti-clipboard"></i></span>
                                        </li>
                                        <li class="col-last">

                                            <h3 class="counter text-right m-t-15">
<?php
$fdate = $this->input->post('date');
$datef = $this->input->post('datef');
?>
<?php $counter = 0?>
<?php foreach ($memberships_users_fun as $memberships_user) {
	?>
<?php foreach ($memberships_fun as $membership) {
		?>

<?php
$mm = date('Y-m-d', strtotime($memberships_user->created_date));
		$uploadDate = $memberships_user->created_date;
		$date = strtotime($uploadDate);
		$date = strtotime($membership->duration * 30 . "day", $date);
		$date = date('Y-m-d', $date);
		?>
            <?php if ($memberships_user->membership_id == $membership->id) {
			?>
            <?php if ($mm >= $fdate && $date > $datef) {$datef = $datef . ' 23:59:59';?>
                                            <?php $counter++;}}}}?>
                                            <?php echo $counter; ?></h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Total active users memberships</h4>
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

                                            <h3 class="counter text-right m-t-15">
<?php
$fdate = $this->input->post('date');
$datef = $this->input->post('datef');

?>
                                            <?php //date_default_timezone_set('Egypt');?>
                                            <?php //$now = date('Y-m-d H:i:s');?>
                                            <?php $counter = 0?>
                                            <?php foreach ($memberships_users_fun as $memberships_user) {
	?>
                                            <?php foreach ($memberships_fun as $membership) {
		?>

<?php
$uploadDate = $memberships_user->created_date;
		$date = strtotime($uploadDate);
		$date = strtotime($membership->duration * 30 . "day", $date);
		$date = date('Y-m-d', $date);
		?>
                                            <?php if ($memberships_user->membership_id == $membership->id) {
			?>
                                            <?php if ($date >= $fdate && $date <= $datef) {
				$datef = $datef . ' 23:59:59';?>
                                             <?php $counter++;}}}}?>
                                            <?php echo $counter; ?>



</h3>
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
                                            <span class="circle circle-md bg-info"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                            <?php echo $notification_provider ?></h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Provider notification</h4>
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
                                            <span class="circle circle-md bg-danger"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                            <?php echo $notification_users ?></h3>
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

                        <div class="white-box">
                            <div class="row row-in">
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-info"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                            <?php echo $provider_parts ?></h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Total Provider Parts</h4>
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
                                            <span class="circle circle-md bg-danger"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                            <?php echo $active_parts ?></h3>
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
                                            <?php echo $in_active_parts ?></h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>In active parts</h4>
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
                                            <?php echo $favorites ?></h3>
                                        </li>
                                        <li class="col-middle">
                                            <h4>Favorite parts</h4>
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

                        <div class="white-box">
                            <div class="row row-in">
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-danger"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                            <?php echo $reviews_pending ?></h3>
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
                                            <?php echo $reviews_rejected ?></h3>
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
                                            <?php echo $reviews_approved ?></h3>
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
                                            <?php echo $active_ads ?></h3>
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

                        <div class="white-box">
                            <div class="row row-in">
                                <div class="col-lg-4 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-danger"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                            <?php echo $booking_completed ?></h3>
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
                                <div class="col-lg-4 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-info"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                            <?php echo $booking_pending ?></h3>
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
                                <div class="col-lg-4 col-sm-6 row-in-br">
                                    <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-success"><i class=" ti-shopping-cart"></i></span>
                                        </li>
                                        <li class="col-last">
                                            <h3 class="counter text-right m-t-15">
                                            <?php echo $booking_rejected ?></h3>
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


