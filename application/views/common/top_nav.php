
<nav class="navbar navbar-default navbar-static-top m-b-0">
<div class="navbar-header">
    <div class="top-left-part">
        <!-- Logo -->
        <a  class="logo" href="<?php echo base_url('/dashboard') ?>">
            <!-- Logo icon image, you can use font-icon also --><b>
            <!--This is dark logo icon--><img src="<?php echo base_url() ?>assets/plugins/images/admin-logo.png" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="<?php echo base_url() ?>assets/plugins/images/admin-logo-dark.png" alt="home" class="light-logo" />
         </b>
            <!-- Logo text image you can use text also --><span class="hidden-xs">
            <!--This is dark logo text--><img src="<?php echo base_url() ?>assets/plugins/images/admin-text.png" alt="home" class="dark-logo" /><!--This is light logo text--><img src="<?php echo base_url() ?>assets/plugins/images/admin-text-dark.png" alt="home" class="light-logo" />
         </span> </a>
    </div>
    <ul class="nav navbar-top-links navbar-left">
        <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
    </ul>
    <ul class="nav navbar-top-links navbar-right pull-right">
        <li class="dropdown">
            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"><b class="hidden-xs"><?php echo $this->session->userdata('email'); ?></b><span class="caret"></span> </a>
            <ul class="dropdown-menu dropdown-user animated flipInY">
                <?php ?>
                <li><a class="text-inverse pr-2" data-toggle="tooltip" href="<?php echo base_url('carmodel/change_password/') ?><?php echo $this->ion_auth->user()->row()->id; ?>"><i class="fa fa-unlock-alt"></i> Change Password</a></li>
                <li><a href="<?php echo base_url('auth/logout'); ?>"><i class="fa fa-power-off"></i> Logout</a></li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
</div>
</nav>