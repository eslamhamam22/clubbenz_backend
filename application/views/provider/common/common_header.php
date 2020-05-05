<!DOCTYPE html>
<html <?php echo $this->session->userdata('site_lang') == "arabic"? 'lang="ar" dir="rtl"' : 'lang="en" dir="ltr"'; ?>>

<head>
   

    <style type="text/css">
        .margin-top{margin-top: 20px;}
        .img_size{
            width: 80px;
        }
        .user_img{
            width: 80px;
            border-radius: 50%;
            background: #80808038;
            height: 80px;
        }
       
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Clubenz</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">

	<?php if($this->session->userdata('site_lang') == "arabic"){ ?>
		<link
			rel="stylesheet"
			href="https://cdn.rtlcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
			integrity="sha384-cSfiDrYfMj9eYCidq//oGXEkMc0vuTxHXizrMOFAaPsLt1zoCUVnSsURN+nef1lj"
			crossorigin="anonymous">
	<?php }else{ ?>
		<link href="<?php echo base_url(); ?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<?php } ?>

    <!-- Menu CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    
    <link href="<?php echo base_url();?>assets/plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />

    <!-- chartist CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url(); ?>assets/css/colors/megna-dark.css" id="theme" rel="stylesheet">
    <link  rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bower_components/datatables/jquery.dataTables.min.css">
    <link  rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css">
    <link  rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bower_components/timepicker/bootstrap-timepicker.min.css">

	
	<!-- DataTable -->
	<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
	<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">

	
	<!-- File Uploader -->
	<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>assets/file-upload/dist/image-uploader.min.css">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>assets/file-upload/dist/karim-image-uploader.css">


	<!-- Force RTL -->

	<?php if($this->session->userdata('site_lang') == "arabic"){ ?>
		<link href="<?php echo base_url(); ?>assets/css/rtl.css" rel="stylesheet">
	<?php } ?>



	<script src="<?php echo  base_url();?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
	<style>
		table.dataTable tbody>tr.selected, table.dataTable tbody>tr>.selected, table.dataTable tbody tr.selected {
			background-color: #B0BED9 !important;
		}
	</style>

</head>


