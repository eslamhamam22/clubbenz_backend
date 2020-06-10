<?php
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
// echo "<pre>";
// print_r($c_a);
// return;
?>
<style>
	#side-menu > li.active > a{
		background: #2cabe3;
		color: #ffffff;
		font-weight: 500;
	}

	.slimScrollBar {
    background: #fff !important;
    opacity: 1 !important;
}
</style>
<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav slimscrollsidebar" style="overflow: hidden; width: auto; height: 100%;">
		<div class="sidebar-head">
			<h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
		<ul class="nav" id="side-menu">
			<?php if ($group_id[0]->name && $group_id[0]->name != 'Part_Providers') {?>
				<li> <a href="<?php echo base_url('/dashboard') ?>" class="waves-effect"><i class="mdi mdi-av-timer fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard <span class="label label-rouded label-inverse pull-right"></span></span></a></li>
			<?php }if (in_array('Preferances/active', $c_a) || in_array('Advertisement/active', $c_a) || $group_id[0]->name == 'admin') {
	?>
				<li>
					<a href="index.html" class="waves-effect "><i data-icon="" class="linea-icon linea-basic fa-fw">P</i> <span class="hide-menu">Preferences <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right"></span></span></a>
					<ul class="nav nav-second-level collapse <?php if ($this->uri->segment(1) == 'classes' || $this->uri->segment(1) == 'fuel' || $this->uri->segment(1) == 'years' || $this->uri->segment(1) == 'location' || $this->uri->segment(1) == 'partcategory' || $this->uri->segment(1) == 'partsubcategory' || $this->uri->segment(1) == 'brand' || $this->uri->segment(1) == 'service_tag' || $this->uri->segment(1) == 'service') {?>in<?php }?>">
						<?php if (true) {?>

						<?php }
	if (in_array('Preferances/active', $c_a) || $group_id[0]->name == 'admin') {
		?>
							<li class="">
								<a href="index.html" class="waves-effect"><i data-icon="" class="ti-car fa-fw"></i> <span class="hide-menu"> Manage Car Details <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right"></span></span></a>
								<ul class="nav  nav-third-level collapse <?php if ($this->uri->segment(1) == 'classes' || $this->uri->segment(1) == 'fuel' || $this->uri->segment(1) == 'years') {?>in<?php }?>">
									<li> <a href="<?php echo base_url() ?>classes/"><i data-icon="" class="linea-icon linea-basic fa-fw">C</i><span class="hide-menu"> Car Classes</span></a> </li>
									<li> <a href="<?php echo base_url() ?>fuel/"><i data-icon="" class="mdi mdi-gas-station fa-fw"></i><span class="hide-menu"> Fuel Type</span></a> </li>
									<li> <a href="<?php echo base_url() ?>years/"><i data-icon="" class=" fa fa-hacker-news fa-fw"></i><span class="hide-menu"> Years</span></a> </li>
									<li> <a href="<?php echo base_url() ?>chassisNumber/"><i data-icon="" class=" linea-icon linea-basic fa-fw">N</i><span class="hide-menu"> Chassis Number</span></a> </li>

								</ul>
							</li>
							<li>
								<a href="index.html" class="waves-effect"><i data-icon="" class="mdi mdi-engine fa-fw"></i> <span class="hide-menu"> Manage parts Details <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right"></span></span></a>
								<ul class="nav  nav-third-level collapse <?php if ($this->uri->segment(1) == 'location' || $this->uri->segment(1) == 'partcategory' || $this->uri->segment(1) == 'partsubcategory' || $this->uri->segment(1) == 'brand') {?>in<?php }?>">
									<?php
if (in_array('Preferances/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>location/"><i data-icon="" class=" ti-world fa-fw"></i><span class="hide-menu"> Location Zone</span></a> </li><?php }
		if (in_array('Preferances/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>partcategory/"><i data-icon="" class="linea-icon linea-basic fa-fw">P</i><span class="hide-menu">Parts Categories</span></a> </li> <?php }
		if (in_array('Preferances/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>partsubcategory/"><i data-icon="" class="linea-icon linea-basic fa-fw">PS</i><span class="hide-menu">Parts Sub Categories</span></a> </li> <?php }
		if (in_array('Preferances/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>brand/"><i data-icon="" class="linea-icon linea-basic fa-fw">BR</i><span class="hide-menu">Parts Brands</span></a> </li> <?php }
		?>
								</ul>
							</li>
						<?php }
	if (in_array('Preferances/active', $c_a) || $group_id[0]->name == 'admin') {
		?>
							<li>
								<a href="index.html" class="waves-effect"><i data-icon="" class="mdi mdi-home fa-fw"></i> <span class="hide-menu"> Manage Shops <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right"></span></span></a>
								<ul class="nav nav-third-level collapse <?php if ($this->uri->segment(1) == 'location' || $this->uri->segment(1) == 'service_tag' || $this->uri->segment(1) == 'service') {?>in<?php }?>">
									<?php
if (in_array('Preferances/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>service_tag/"><i data-icon="" class=" mdi mdi-settings fa-fw"></i><span class="hide-menu">Manage Service Tags</span></a> </li>  <?php }
		if (in_array('Preferances/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>service/"><i data-icon="" class="mdi mdi-settings fa-fw"></i><span class="hide-menu">Service Types</span></a> </li> <?php }
		?>
								</ul>
							</li>
						<?php }
	if (in_array('Preferances/active', $c_a) || $group_id[0]->name == 'admin') {?>
							<li> <a href="<?php echo base_url() ?>profile_image/"><i data-icon="" class="ti-image fa-fw"></i><span class="hide-menu">Manage Profile Image</span></a> </li> <?php }
	if (in_array('Partgroup/active', $c_a) || $group_id[0]->name == 'admin') {?>
							<li>  </li><?php }
	if (in_array('Advertisement/active', $c_a) || $group_id[0]->name == 'admin') {?>
							<li> <a href="<?php echo base_url() ?>advertisement/"class="waves-effect"><i class="" data-icon="">A</i> <span class="hide-menu"> Advertisement <span class="label label-rouded label-inverse pull-right"></span></span></a></li><?php }?>
					</ul>
				</li> <?php }?>  <!-- preferances end-->

			<?php
if (in_array('Listing/active', $c_a) || $group_id[0]->name == 'Part_Providers' || $group_id[0]->name == 'admin') {
	?>
				<li>
					<a href="index.html" class="waves-effect "><i data-icon="" class="linea-icon linea-basic fa-fw">L</i> <span class="hide-menu"> Listing <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right"></span></span></a>
					<ul class="nav nav-second-level collapse <?php if (($this->uri->segment(2) != 'solution' && $this->uri->segment(2) != 'edit_error_solution' && $this->uri->segment(2) != 'part') && ($this->uri->segment(1) == 'cars' || $this->uri->segment(1) == 'workshop' || $this->uri->segment(1) == 'partshop' || $this->uri->segment(1) == 'serviceshop' || $this->uri->segment(1) == 'car_guide')) {?>in<?php }?>">
						<?php
if ($group_id[0]->name == 'Part_Providers') {
		if (true) {?><li> <a href="<?php echo base_url() ?>part/"><i data-icon="" class="linea-icon linea-basic fa-fw">P</i><span class="hide-menu">Listing Parts</span></a> </li><?php }
	} else {
		if (in_array('Listing/active', $c_a) || $group_id[0]->name == 'admin') {?>
			<li> <a href="<?php echo base_url() ?>cars/"><i data-icon="" class=" fa-fw mdi mdi-car"></i><span class="hide-menu">Listing Cars</span></a> </li><?php }

		if (in_array('Listing/active', $c_a) || $group_id[0]->name == 'admin') {?>
			<li> <a href="<?php echo base_url() ?>workshop/"><i data-icon="" class="icon-wrench fa-fw"></i><span class="hide-menu">Listing WorksShops</span></a> </li>   <?php }

		if (in_array('Listing/active', $c_a) || $group_id[0]->name == 'admin') {?>
			<li> <a href="<?php echo base_url() ?>partshop/"><i data-icon="" class="linea-icon linea-basic fa-fw">P</i><span class="hide-menu">Listing PartsShop</span></a> </li><?php }

		if (in_array('Listing/active', $c_a) || $group_id[0]->name == 'admin') {?>
			<li> <a href="<?php echo base_url() ?>serviceshop/"><i data-icon="" class="mdi mdi-settings-box fa-fw"></i><span class="hide-menu">Listing Service Shops</span></a> </li> <?php }
	}
	if (in_array('Listing/active', $c_a) || $group_id[0]->name == 'admin') {
		?>
							<li>
								<a href="index.html" class="waves-effect"><i data-icon="" class="mdi mdi-home fa-fw"></i> <span class="hide-menu">Car Guide <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right"></span></span></a>
								<ul class="nav nav-third-level collapse <?php if (($this->uri->segment(1) == 'car_guide' || $this->uri->segment(1) == 'car_guide/manage_cluster_error')) {?>in<?php }?>">
									<?php
if (in_array('Listing/active', $c_a) || $group_id[0]->name == 'admin') {?><li><a href="<?php echo base_url() ?>car_guide/index"><i data-icon="" class="  mdi-settings fa-fw"></i><span class="hide-menu">Listing Car Guide</span></a> </li><?php }
		if (in_array('Listing/active', $c_a) || $group_id[0]->name == 'admin') {?><li><a href="<?php echo base_url() ?>car_guide/manage_cluster_error"><i data-icon="" class=" mdi-settings fa-fw"></i><span class="hide-menu">Cluster Errors!chassis</span></a> </li><?php }?>
								</ul>
							</li>
						<?php }?>
					</ul>
				</li> <!-- Listing end-->

			<?php }
if (in_array('Booking/active', $c_a) || $group_id[0]->name == 'admin') {?>
				<li><a class="waves-effect " href="<?php echo base_url() ?>booking/"><i data-icon="" class=" linea-basic fa-fw">B</i> <span class="hide-menu">Booking <span class="label label-rouded label-inverse pull-right"></span></span></a></li>
			<?php }

if (in_array('Users/active', $c_a) || $group_id[0]->name == 'admin') {?>

				<li>
					<a href="index.html" class="waves-effect "><i data-icon="" class="ti-user fa-fw"></i> <span class="hide-menu"> Users <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right"></span></span></a>

					<ul class="nav nav-second-level"><?php if ($group_id[0]->name == 'admin') {?>

							<li> <a href="<?php echo base_url() ?>permissions/"> <i data-icon="" class="linea-icon linea-basic fa-fw"></i>
									<span class="hide-menu">User Groups</span></a> </li>

							<li> <a href="<?php echo base_url() ?>permissions/group_base_permissions"><i data-icon="" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">User Permissions</span></a> </li>

						<?php }if (in_array('Users/active', $c_a) || $group_id[0]->name == 'admin') {?>
							<li> <a href="<?php echo base_url() ?>permissions/user_manage"><i data-icon="" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Manage Users</span></a> </li> <?php }?>
					</ul>
				</li>
			<?php }?>



			<?php if (in_array('Parts_Catalogue/active', $c_a) || $group_id[0]->name == 'admin') {?>

				<li>
					<a href="index.html" class="waves-effect "><i data-icon="" class="linea-icon linea-basic fa-fw">P</i> <span class="hide-menu"> Parts Catalogue <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right"></span></span></a>

					<ul class="nav nav-second-level <?php if ($this->uri->segment(1) == 'feature' || $this->uri->segment(1) == 'plan' || $this->uri->segment(1) == 'providerlist' || $this->uri->segment(1) == 'part' || $this->uri->segment(1) == 'shippment' || $this->uri->segment(1) == 'shippinglist' || $this->uri->segment(1) == 'reviews/provider') {?>in<?php }?>">

						<?php if (in_array('Parts_Catalogue/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>catalog/"class="waves-effect "><i class="" data-icon="">A</i> <span class="hide-menu"> Manage Parts Catalogue <span class="label label-rouded label-inverse pull-right"></span></span></a></li><?php }?>

						<li>
							<a href="index.html" class="waves-effect "><i data-icon="" class="linea-icon linea-basic fa-fw">P</i> <span class="hide-menu"> Provider <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right"></span></span></a>
							<ul class="nav nav-third-level collapse <?php if (($this->uri->segment(2) != 'provider') && $this->uri->segment(1) == 'feature' || $this->uri->segment(1) == 'plan' || $this->uri->segment(1) == 'providerlist' || $this->uri->segment(1) == 'part' || $this->uri->segment(1) == 'shippment' || $this->uri->segment(1) == 'shippinglist' || $this->uri->segment(1) == 'reviews/provider') {?>in<?php }?>">

								<?php if (in_array('Parts_Catalogue/active', $c_a) || $group_id[0]->name == 'admin') {?>
								<li> <a href="<?php echo base_url() ?>part/"><i data-icon="" class="linea-icon linea-basic fa-fw">P</i><span class="hide-menu">Listing Parts</span></a> </li><?php }?>

								<?php if (in_array('Parts_Catalogue/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>feature/"class="waves-effect"><i data-icon="" class="linea-icon linea-basic fa-fw">P</i> <span class="hide-menu">Featured list <span class="label label-rouded label-inverse pull-right"></span></span></a></li> <?php }?>

								<?php if (in_array('Parts_Catalogue/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>plan/"class="waves-effect"><i data-icon="" class="linea-icon linea-basic fa-fw">P</i> <span class="hide-menu">Subscription Plans <span class="label label-rouded label-inverse pull-right"></span></span></a></li> <?php }?>

								<?php if (in_array('Parts_Catalogue/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>providerlist/"class="waves-effect"><i data-icon="" class="linea-icon linea-basic fa-fw">P</i> <span class="hide-menu">Providers List  <span class="label label-rouded label-inverse pull-right"></span></span></a></li> <?php }?>


								<?php if (in_array('Parts_Catalogue/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>shippment/"class="waves-effect"><i data-icon="" class="linea-icon linea-basic fa-fw">P</i> <span class="hide-menu">Shipment Cost<span class="label label-rouded label-inverse pull-right"></span></span></a></li> <?php }?>

								<?php if (in_array('Parts_Catalogue/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>shippinglist/"class="waves-effect"><i data-icon="" class="linea-icon linea-basic fa-fw">P</i> <span class="hide-menu">Shipping Requests<span class="label label-rouded label-inverse pull-right"></span></span></a></li> <?php }?>

								<?php if (in_array('Parts_Catalogue/provider', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>reviews/provider"class="waves-effect"><i data-icon="" class="linea-icon linea-basic fa-fw">P</i> <span class="hide-menu">User Reviews <span class="label label-rouded label-inverse pull-right"></span></span></a></li> <?php }?>

							</ul>
						</li>
					</ul>

				</li> <?php }?>



			<li>
		<?php if (in_array('Membership/active', $c_a) || $group_id[0]->name == 'admin') {?>
				<li>
					<a href="index.html" class="waves-effect "><i data-icon="" class="ti-user fa-fw"></i> <span class="hide-menu"> Memberships <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right"></span></span></a>

					<ul class="nav nav-second-level"><?php if ($group_id[0]->name == 'admin') {?>

							<li> <a href="<?php echo base_url() ?>membership/index"class="waves-effect "><i class="" data-icon="">A</i> <span class="hide-menu">Membership details<span class="label label-rouded label-inverse pull-right"></span></span></a></li>

							<li> <a href="<?php echo base_url() ?>membership/membership_features"class="waves-effect "><i class="" data-icon="">A</i> <span class="hide-menu">Membership Features<span class="label label-rouded label-inverse pull-right"></span></span></a></li>

							<li> <a href="<?php echo base_url() ?>membership/membership_request"class="waves-effect "><i class="" data-icon="">A</i> <span class="hide-menu">Membership request<span class="label label-rouded label-inverse pull-right"></span></span></a></li>


						<li> <a href="<?php echo base_url() ?>membership/membership_setting"class="waves-effect "><i class="" data-icon="">A</i> <span class="hide-menu">Membership Settings<span class="label label-rouded label-inverse pull-right"></span></span></a></li>

					</ul>
				</li>
			<?php }?>
			<?php }?>


			<?php if (in_array('Push_notification/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>push_notification/manage_notification/"class="waves-effect "><i class="" data-icon="">A</i> <span class="hide-menu">Push Notification<span class="label label-rouded label-inverse pull-right"></span></span></a></li> <?php }?>

			<?php if (in_array('Reviews/index', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>reviews/index"class="waves-effect "><i class="" data-icon="">A</i> <span class="hide-menu"> user reviews <span class="label label-rouded label-inverse pull-right"></span></span></a></li><?php }?>

			<?php if (in_array('Pendning_solutions/active', $c_a) || $group_id[0]->name == 'admin') {?><li> <a href="<?php echo base_url() ?>car_guide/solution"class="waves-effect "><i class="" data-icon="">A</i> <span class="hide-menu"> Solution Pending <span class="label label-rouded label-inverse pull-right"></span></span></a></li><?php }?>
			</li>
		</ul>
	</div>
</div>
<script>
	$(document).ready(function () {
        $(window).load(function() {
            $( "li:has(ul li.active) > a" ).addClass('active');
		})

    })
</script>
