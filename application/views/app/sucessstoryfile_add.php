
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
					 FIDA UGANDA
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			
			
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i> Add a sucess story file
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
                               
							?> 
							<!-- BEGIN FORM-->
							<form action="<?= site_url('App/files_submition/'); ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
								<?php
									if($this->session->flashdata('error')){


										echo '<div class="alert alert-danger">
										<button class="close" data-close="alert"></button><span>'.$this->session->flashdata('error').'</span></div>';
									}

		?>
		                                <div class="form-group">
													<label class="col-md-3 control-label">Title:</label>
													<div class="col-md-4">
														<input type="text" class="form-control"  required="required" name="title">
														<span class="help-block">
														What is the title of the file. </span>
													</div>
												</div>
								<div class="form-group">
													<label class="col-md-3 control-label">Success story:</label>
													<div class="col-md-4">
														<select class="form-control" name="story">
															<option value="0">Select story</option>
														<?php 

												            foreach($story as $stori)
												            { 
												               echo '<option value="'.$stori['id'].'">'.$stori['title'].'</option>';
												            }
												            ?>
													</select>
													
													<span class="help-block">
															Choose the sucess story. </span>
													</div>
												</div>	
												
												<div class="form-group">
													<label class="col-md-3 control-label">File type:</label>
													<div class="col-md-4">
														<select class="form-control" name="type" id="ty">
															<option value="0">Select file type</option>
															<option value="pdf">pdf</option>
															<option value="image">image</option>
															<option value="video">video</option>
															<option value="other">other</option>
														
													</select>
													
													<span class="help-block">
															Choose the file type to upload. </span>
													</div>
												</div>	
												<div class="form-group hide" id="pdftype" >
													<label class="col-md-3 control-label">File:</label>
													<div class="col-md-4 fil">
														
														<span class="help-block">
														Add a pdf . </span>
													</div>
												</div>
												<div class="form-group hide" id="imagetype" >
													<label class="col-md-3 control-label" >File:</label>
													<div class="col-md-4 fil1">
														
														<span class="help-block">
														Add an image . </span>
													</div>
												</div>
												<div class="form-group hide" id="videotype">
													<label class="col-md-3 control-label">File:</label>
													<div class="col-md-4 fil2">
														
														<span class="help-block">
														Add a video . </span>
													</div>
												</div>
												<div class="form-group hide"id="othertype" >
													<label class="col-md-3 control-label">File:</label>
													<div class="col-md-4 fil3">
														
														<span class="help-block">
														Add any other file . </span>
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
		 <?= date('Y'); ?> &copy; FIDA UGANDA.
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
        $(document).ready(function(){
	$('#ty').change(function(){
		var type = $('#ty').val();
		if(type == 'pdf'){
			$('#pdftype').removeClass('hide');
			$('.fil').html('<input type="file"  name="file" accept="application/pdf" >');
		}else{
			$('#pdftype').addClass('hide');
		}

		if(type == 'image'){
			$('#imagetype').removeClass('hide');
			$('.fil1').html('<input type="file"  name="file" accept="image/*" >');
			
		}else{
			$('#imagetype').addClass('hide');
		}
		if(type == 'video'){
			$('#videotype').removeClass('hide');
			$('.fil2').html('<input type="file"  name="file" accept="video/*" >');
			
		}else{
			$('#videotype').addClass('hide');
		}
		if(type == 'other'){
			$('#othertype').removeClass('hide');
			$('.fil3').html('<input type="file"  name="file">');
			
		}else{
			$('#othertype').addClass('hide');
		}
	});
});
    </script>
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