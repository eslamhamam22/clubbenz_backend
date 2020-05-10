
<nav class="navbar navbar-default navbar-static-top m-b-0">
<div class="navbar-header">
    <div class="top-left-part">
        <!-- Logo -->
        <a  class="logo" href="<?echo base_url('/provider/dashboard')?>">
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
    <!-- s -->
    <ul class="nav navbar-top-links navbar-right pull-right">
        <?php if ($this->session->userdata('site_lang') == "arabic") {?>
                    <li><a href="<?php echo base_url('provider/langSwitch/switchLanguage/english'); ?>"><i class="fa fa-language"></i> English</a></li>
                <?php } else {?>
                    <li><a href="<?php echo base_url('provider/langSwitch/switchLanguage/arabic'); ?>"><i class="fa fa-language"></i> العربية</a></li>
                <?php }?>
        <li class="dropdown">
            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"><b class="hidden-xs"><?php echo $this->session->userdata('user_email'); ?></b><span class="caret"></span> </a>
            <ul class="dropdown-menu dropdown-user animated flipInY">
                <li><a href="<?php echo base_url('provider/home/logout'); ?>"><i class="fa fa-power-off"></i> Logout</a></li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
</div>
</nav>
