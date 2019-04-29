	<!DOCTYPE html>
	<html lang="en">
	<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
	<meta charset="utf-8"/>
	<title>HONEY PRIDE UGANDA | <?= $title; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="<?= base_url(); ?>assets/admin/pages/css/login2.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL SCRIPTS -->
	<!-- BEGIN TIME AND DATE LEVEL STYLES -->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/global/plugins/clockface/css/clockface.css"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
	<!-- END TIME AND DATE LEVEL STYLES -->
	<!-- BEGIN THEME STYLES -->
	<link href="<?= base_url(); ?>assets/global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url(); ?>assets/global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url(); ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url(); ?>assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="<?= base_url(); ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="<?= base_url(); ?>assets/images/honeypridelogo.jpg"/>
	</head>
	<!-- END HEAD -->
	<!-- BEGIN BODY -->
	<body class="page-md login">
	<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
	<div class="menu-toggler sidebar-toggler">
	</div>
	<!-- END SIDEBAR TOGGLER BUTTON -->
	<!-- BEGIN LOGO -->
	<div class="logo">
		<a href="#">
		<img src="<?= base_url(); ?>assets/images/honeypridelogo.jpg" width="120" alt=""/>
		</a>
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->

		<?php echo validation_errors(); ?>
		<form class="login-form" action="<?= site_url('App/login'); ?>" method="post">
		<?php
		if($this->session->flashdata('error')){


			echo '<div class="alert alert-danger">
			<button class="close" data-close="alert"></button><span>'.$this->session->flashdata('error').'</span></div>';
		}
		if($this->session->flashdata('success')){


			echo '<div class="alert alert-danger">
			<button class="close" data-close="alert"></button><span>'.$this->session->flashdata('success').'</span></div>';
		}

		?>
			<h3 class="form-title">HONEY PRIDE UGANDA</h3>
			<div class="alert alert-danger display-hide">
				<button class="close" data-close="alert"></button>
				<span>
				<?php echo form_error('password'); ?> </span>
			</div>
			<div class="form-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

				<label class="control-label visible-ie8 visible-ie9">Email</label>
				<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="email" name="email"/>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-success uppercase">Login</button>
				
			</div>
			<div class="login-options">
				
			</div>
		
		</form>
		<!-- END LOGIN FORM -->
		
	</div>
	<div class="copyright">
		 <?= date('Y'); ?> © HONEY PRIDE UGANDA.
	</div>
	<!-- END LOGIN -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
	<script src="<?= base_url(); ?>assets/global/plugins/respond.min.js"></script>
	<script src="<?= base_url(); ?>assets/global/plugins/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?= base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/clockface/js/clockface.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?= base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?= base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/admin/pages/scripts/login.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/admin/pages/scripts/components-pickers.js"></script>
	<!-- END PAGE LEVEL SCRIPTS -->

	<script>
	jQuery(document).ready(function() {
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	Login.init();
	Demo.init();
	 ComponentsPickers.init();
	});
	</script>
	<!-- END JAVASCRIPTS -->
	</body>
	<!-- END BODY -->
	</html>
