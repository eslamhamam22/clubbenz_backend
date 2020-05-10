<div class="navbar-default sidebar" role="navigation">
   <div class="sidebar-nav slimscrollsidebar" style="overflow: hidden; width: auto; height: 100%;">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
        <ul class="nav" id="side-menu">
            <li> <a href="<?php echo base_url('/provider/home') ?>" class="waves-effect"><i class="mdi mdi-av-timer fa-fw" data-icon="v"></i> <span class="hide-menu"> <?php echo lang("Dashboard"); ?> <span class="label label-rouded label-inverse pull-right"></span></span></a></li>
            <li> <a href="<?php echo base_url('/provider/parts') ?>" class="waves-effect"><i class="linea-icon linea-basic fa-fw">P</i> <span class="hide-menu"> <?php echo lang("Parts"); ?> <span class="label label-rouded label-inverse pull-right"></span></span></a></li>


			<li>
				<a href="<?php echo base_url('/provider/shipping') ?>" class="waves-effect"><i class="linea-icon linea-basic fa-fw">P</i><span class="hide-menu"> <?php echo lang("Shipping"); ?> <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right"></span></span></a>
				<ul class="nav nav-third-level collapse <?php if ($this->uri->segment(2) == 'shipping') {?>in<?php }?>">
					<li> <a href="<?php echo base_url('/provider/shipping/index') ?>" class="waves-effect"><i class="linea-icon linea-basic fa-fw">S</i><span class="hide-menu"> <?php echo lang("Shipping"); ?> <span class="label label-rouded label-inverse pull-right"></span></span></a></li>
					<li> <a href="<?php echo base_url('/provider/shipping/request') ?>" class="waves-effect"><i class="linea-icon linea-basic fa-fw">R</i><span class="hide-menu"> <?php echo lang("Shipping_request"); ?> <span class="label label-rouded label-inverse pull-right"></span></span></a></li>
				</ul>
			</li>
			<li>
				<a href="<?php echo base_url('/provider/plan') ?>" class="waves-effect"><i class="linea-icon linea-basic fa-fw">P</i><span class="hide-menu"> <?php echo lang("Plans"); ?> <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right"></span></span></a>
				<ul class="nav  nav-third-level collapse <?php if ($this->uri->segment(2) == 'plan') {?>in<?php }?>">
					<li> <a href="<?php echo base_url('/provider/plan/index') ?>" class="waves-effect"><i class="linea-icon linea-basic fa-fw">P</i><span class="hide-menu"> <?php echo lang("Plans"); ?>  <span class="label label-rouded label-inverse pull-right"></span></span></a></li>
					<li> <a href="<?php echo base_url('/provider/plan/history') ?>" class="waves-effect"><i class="linea-icon linea-basic fa-fw">H</i><span class="hide-menu"> <?php echo lang("Plan_history"); ?>  <span class="label label-rouded label-inverse pull-right"></span></span></a></li>
				</ul>
			</li>
			<li> <a href="<?php echo base_url('/provider/provider') ?>" class="waves-effect"><i class="ti-user fa-fw" data-icon="v"></i> <span class="hide-menu"> <?php echo lang("Profile"); ?> <span class="label label-rouded label-inverse pull-right"></span></span></a></li>
        </ul>
    </div>
</div>
