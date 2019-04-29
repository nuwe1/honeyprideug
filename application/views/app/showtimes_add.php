
			<!-- BEGIN PAGE CONTENT-->
			<div class="page-content-wrapper">
			<div class="page-content">
			<!-- BEGIN PAGE HEAD -->
			<div class="page-head">
				
			</div>
			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb hide">
				<li>
					<a href="javascript:;">Home</a><i class="fa fa-circle"></i>
				</li>
				<li class="active">
					 CINEMA UG
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			
			
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet box red-sunglo">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-desktop"></i> Add a showtime
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
						<?php
                               $id = $this->uri->segment(3);
                               $cost= $this->uri->segment(4);
							?> 
							<!-- BEGIN FORM-->
							<form action="<?= site_url('App/showtime_submition'); ?>" class="form-horizontal form-bordered" method="post">
								<?php
									if($this->session->flashdata('error')){


										echo '<div class="alert alert-danger">
										<button class="close" data-close="alert"></button><span>'.$this->session->flashdata('error').'</span></div>';
									}

		?>
								<div class="form-body form">
                
						             <div class="form-group">
										<label class="col-md-3 control-label">Cinema:</label>
										<div class="col-md-4">
										<select class="form-control" name="cinema">
											<?php 

									            foreach($cinemas as $cinema)
									            { 
									              echo '<option value="'.$cinema['cinema_id'].'">'.$cinema['cinema_username'].'</option>';
									            }
									            ?>
										</select>
										<span class="help-block">
												Choose the Cinema name from the list. </span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Movie:</label>
										<div class="col-md-4">
										<select class="form-control" name="movie">
											<?php 

									            foreach($movies as $movie)
									            { 
									              echo '<option value="'.$movie['movie_id'].'">'.$movie['mname'].'</option>';
									            }
									            ?>
										</select>
										<span class="help-block">
												Choose the Movie name from the list. </span>
										</div>
									</div>
												
									<div class="form-group">
										<label class="control-label col-md-3">Date:</label>
										<div class="col-md-4">
									 <input type="text" class="form-control" placeholder="Enter date" name="date">
									       <span class="help-block">
									       Enter the date. </span>
								            </div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Time:</label>
										
									<div class="col-md-4">
									 <input type="text" class="form-control" placeholder="Enter time" name="time">
									       <span class="help-block">
									       Enter the time. </span>
								            </div>
											
									</div>
								<div class="form-group">
								<label class="col-md-3 control-label">Pricing:</label>
								<div class="col-md-4">
									<input type="text" class="form-control" placeholder="Enter price" name="price">
									<span class="help-block">
									Enter the price. </span>
								</div>
								</div>
									<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple"><i class="fa fa-check"></i> Submit</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
								</div>
							</form>
							
							<!-- END FORM-->
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
			
			
			<!-- END PAGE CONTENT-->
		</div>
	
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 <?= date('Y'); ?> &copy; CINEMA UG.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?= base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?= base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/pages/scripts/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
        jQuery(document).ready(function() {       
           // initiate layout and plugins
           Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
           ComponentsPickers.init();
        });   
    </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>