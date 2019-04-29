
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
								<i class="fa fa-user"></i> Add our contact
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
							<form action="<?= site_url('App/our_contact_submition'); ?>" class="form-horizontal form-bordered" method="post">
								<?php
									if($this->session->flashdata('error')){


										echo '<div class="alert alert-danger">
										<button class="close" data-close="alert"></button><span>'.$this->session->flashdata('error').'</span></div>';
									}

		?>
							
								<div class="form-body">
									
								<div class="form-group" id="init-mision">
										<label class="control-label col-md-2">Our contact:</label>
										<div class="col-md-10 mision">
											<textarea class="form-control"  id="summernote_1" name="en_description" rows="6"><?=$objective['content'];?></textarea>
										</div>
									</div>
                                    								
									 
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-2 col-md-10">
											<button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
											<button type="button" class="btn default">Cancel</button>
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
<script src="<?= base_url(); ?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
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
<!-- END PAGE LEVEL SCRIPTS -->
<script>
	var ComponentsEditors = function () {
    
    var handleWysihtml5 = function () {
        if (!jQuery().wysihtml5) {
            return;
        }

        if ($('.wysihtml5').size() > 0) {
            $('.wysihtml5').wysihtml5({
                "stylesheets": ["../../assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
            });
        }
    }

    var handleSummernote = function () {
        $('#summernote_1').summernote({height: 300});
        //API:
        //var sHTML = $('#summernote_1').code(); // get code
        //$('#summernote_1').destroy(); // destroy
    }

    var handleSummernote1 = function () {
        $('#summernote_2').summernote({height: 300});
        //API:
        //var sHTML = $('#summernote_1').code(); // get code
        //$('#summernote_1').destroy(); // destroy
    }

    return {
        //main function to initiate the module
        init: function () {
            handleWysihtml5();
            handleSummernote();
            handleSummernote1();
        }
    };

}();
</script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
       $(document).ready(function(){
        	//next-vision
			$('#lang').change(function(){
				var type = $('#lang').val();
				if(type == 'english'){
				
					$('#init-mision').removeClass('hide');
					$('#next-mision').addClass('hide');
				}
				else if(type == 'luganda')
				{
					$('#init-mision').addClass('hide');
					$('#next-mision').removeClass('hide');
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
   ComponentsEditors.init();
});   
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>