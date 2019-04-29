
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
					 HONEY PRIDE UGANDA
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			
			
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i> Add a success story
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
							<form action="<?= site_url('App/sucessstory_submition/'); ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
								<?php
									if($this->session->flashdata('error')){


										echo '<div class="alert alert-danger">
										<button class="close" data-close="alert"></button><span>'.$this->session->flashdata('error').'</span></div>';
									}

		?>
								<div class="form-body form">
									<div class="form-group">
													<label class="col-md-2 control-label">Name:</label>
													<div class="col-md-4">
														<input type="text" class="form-control"  required="required" name="name">
														<span class="help-block">
														Who is the success story about. </span>
													</div>
												</div>
                                           <div class="form-group">
													<label class="col-md-2 control-label">Title:</label>
													<div class="col-md-4">
														<input type="text" class="form-control"  required="required" name="title">
														<span class="help-block">
														What is the job title of the person. </span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Story content:</label>
													<div class="col-md-10">
														<textarea class="form-control"  id="summernote_1"   name="content"   rows="6"  ></textarea>
														<span class="help-block">
														What is the content of the story.  </span>
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
		 <?= date('Y'); ?> &copy; HONEY PRIDE UGANDA.
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/pages/scripts/components-editors.js"></script>
<script src="<?= base_url(); ?>assets/admin/pages/scripts/components-pickers.js"></script>
<script type="text/javascript">
			$(document).ready(function() {
			var max_fields      = 10;
			var wrapper         = $(".container1");
			var add_button      = $(".add_form_field");

			var x = 1;
			$(add_button).click(function(e){
			e.preventDefault();
			if(x < max_fields){
			x++;
			$(wrapper).append('<br><div><div><input type="text" class= "form-control" id="ex3" name="subcategory[]"></div> <a href="#" class="delete btn btn-danger">Delete</a></div>'); //add input box
			}
			else
			{
			alert('You Reached the tag limits')
			}
			});

			$(wrapper).on("click",".delete", function(e){
			e.preventDefault(); $(this).parent('div').remove(); x--;
			})
			});
    </script>

    <style type = "text/css">
    
    .add_form_field
    {
      background-color: #1c97f3;
      border: none;
      color: white;
      padding: 8px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      border:1px solid #186dad;
    }

    

    .delete{
      background-color: #fd1200;
      border: none;
      color: white;
      padding: 5px 15px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 14px;
      margin: 4px 2px;
      cursor: pointer;
    }
    </style>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
        jQuery(document).ready(function() {       
           // initiate layout and plugins
           Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
ComponentsEditors.init();
           ComponentsPickers.init();
        });   
    </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>