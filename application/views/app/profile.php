	<!-- BEGIN CONTENT -->
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
								<i class="fa fa-user"></i>My Profile
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
						<div class="portlet-body">
						<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PROFILE SIDEBAR -->
					<div class="profile-sidebar" style="width:250px;">
						<!-- PORTLET MAIN -->
						<div class="portlet light profile-sidebar-portlet">
							<!-- SIDEBAR USERPIC -->
							<div class="profile-userpic">
								<img src="<?= base_url(); ?>assets/images/admins/<?=$image;?>" class="img-responsive" alt="">
							</div>
							<!-- END SIDEBAR USERPIC -->
							<!-- SIDEBAR USER TITLE -->
							<div class="profile-usertitle">
								<div class="profile-usertitle-name">
									 <?=$user;?>
								</div>
								<div class="profile-usertitle-job">
									 User
								</div>
							</div>
							<!-- END SIDEBAR USER TITLE -->
							
							<!-- SIDEBAR MENU -->
							<div class="profile-usermenu">
								<hr/>
								<ul class="nav">
			
									<li class="active">
										<a href="<?= site_url('App/profile'); ?>">
										<i class="fa fa-user"></i>
										Update profile  </a>
									</li>
									
								</ul>
							</div>
							<!-- END MENU -->
						</div>
						<!-- END PORTLET MAIN -->
						
					</div>
					<!-- END BEGIN PROFILE SIDEBAR -->
					<!-- BEGIN PROFILE CONTENT -->
					<div class="profile-content">
						<div class="row">
							<div class="col-md-12">
								<div class="portlet light">
									<div class="portlet-title tabbable-line">
										<div class="caption caption-md">
											<i class="icon-globe theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
										</div>
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_1_1" data-toggle="tab">Personal Info</a>
											</li>
											<li>
												<a href="#tab_1_2" data-toggle="tab">edit password</a>
											</li>
											<li>
												<a href="#tab_1_3" data-toggle="tab">Edit photo</a>
											</li>
											<li>
												<a href="#tab_1_4" data-toggle="tab">New Users</a>
											</li>
											<li>
												<a href="#tab_1_5" data-toggle="tab">Available Users</a>
											</li>
											
										</ul>
									</div>
									<?php
                               $id = $this->uri->segment(3);
                               
							?> 
									<div class="portlet-body">
										<div class="tab-content">
											<!-- PERSONAL INFO TAB -->
											<div class="tab-pane active" id="tab_1_1">
												<?php
									if($this->session->flashdata('error')){


										echo '<div class="alert alert-danger">
										<button class="close" data-close="alert"></button><span>'.$this->session->flashdata('error').'</span></div>';
									}

		                            ?>
												<form role="form" action="<?= site_url('App/update_name'); ?>" method="post" enctype="multipart/form-data">
													<div class="form-group">
														<label class="control-label">Full Name</label>
														<input type="text" required="required"  value="<?=$user;?>" name="fullname" class="form-control"/>
													</div>
													
													<div class="form-group">
														<label class="control-label">Current Password</label>
														<input type="password" required="required"  name="password" class="form-control"/>
													</div>
													
													
													<div class="margiv-top-10">
														<button type="submit" class="btn btn-red ">Submit</button>
														<button href="javascript:;" class="btn default">
														Cancel </button>
														
													</div>
												</form>
											</div>
											<!-- END PERSONAL INFO TAB -->
											<!-- CHANGE PASSWORD INFO TAB -->
											<div class="tab-pane" id="tab_1_2">
												
												<form role="form" action="<?= site_url('App/update_details'); ?>" method="post" enctype="multipart/form-data">
													
													
													<div class="form-group">
														<label class="control-label">Current Password</label>
														<input type="password" required="required"  name="password" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">New Password</label>
														<input type="password" required="required"   name="newpassword" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Re-type New Password</label>
														<input type="password" required="required"  name="passconf" class="form-control"/>
													</div>

													
													<div class="margiv-top-10">
														<button type="submit" class="btn btn-red ">Submit</button>
														<button href="javascript:;" class="btn default">
														Cancel </button>
														
													</div>
												</form>
											</div>
											<!-- END CHANGE PASSWORD INFO TAB -->
											<!-- PHOTO USER TAB -->
											<div class="tab-pane" id="tab_1_3">
												<form action="<?= site_url('App/edit_users_picture'); ?>" method="post" enctype="multipart/form-data">
													<?php echo validation_errors(); ?>
													<div class="form-group">
														<div class="fileinput fileinput-new" data-provides="fileinput">
															<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
															</div>
															<div>
																<span class="btn default btn-file">
																<span class="fileinput-new">
																Select image </span>
																<span class="fileinput-exists">
																Change </span>
																<input type="file" name="image" accept="image/*">
																</span>
																<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput">
																Remove </a>
															</div>
														</div>
														<div class="clearfix margin-top-10">
															<span class="label label-danger">NOTE! </span>
															<span>Please upload an image</span>
														</div>
													</div>
													<div class="margin-top-10">
														<button type="submit" class="btn btn-red ">Submit</button>
														<button href="javascript:;" class="btn default">
														Cancel </button>
													</div>
												</form>
											</div>
											<!-- END PHOTO NEW USER TAB -->
											<!-- CREATE NEW USER TAB -->
											<div class="tab-pane" id="tab_1_4">
												<form action="<?= site_url('App/profile_submission'); ?>" method="post">
													<?php echo validation_errors(); ?>
													<div class="form-group">
														<label class="control-label">Full Name</label>
														<input type="text" required="required"   name="name" class="form-control"/>
													</div>
													
													<div class="form-group">
														<label class="control-label">Password</label>
														<input type="password" required="required"  name="password" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Confirm Password</label>
														<input type="password" required="required"   name="passconf" class="form-control"/>
													</div>
													<div class="form-group">
														<label class="control-label">Email</label>
														<input type="text" required="required"  name="email" class="form-control"/>
													</div>
													<div class="margin-top-10">
														<button type="submit" class="btn btn-red ">Submit</button>
														<button href="javascript:;" class="btn default">
														Cancel </button>
													</div>
												</form>
											</div>
											<!-- END CREATE NEW USER TAB -->
											<!-- AVAILABLE USERS TAB -->
											<div class="tab-pane" id="tab_1_5">
												<table class="table table-striped table-hover" id="sample_5">
							
										
										<?php 
                                    $counter = 1;
                                    if ($email!= "admin@fidakiosk.org"){
                                    	echo '<thead >
                                         <th>No</th>
                                         <th> Name</th>
                                         <th>Email</th>
                                         <th>Image</th>
                                      </thead>
                                      <tbody>	';

                                    	if( !empty($users) ) {
                                      foreach ($users as $user) {

                                        
                                        echo '<tr class="odd gradeX">
                                        <td>'.$counter.'</td>
                                        
                                        <td>'.$user['admin_fullname'].'</td>
                                        <td>'.$user['admin_email'].'</td>
                                        <td class="center"><img src="'.base_url().'assets/images/admins/'.$user['admin_pic'].'" alt="no image" class="thumbnail"height="75em" width="75em">'.
                                        '</td>
                                        
                                        
                                        </tr>';

                                        $counter++;
                                      }
                                    }

                                    }else {
                                    	echo '<thead >
                                         <th>No</th>
                                         <th> Name</th>
                                         <th>Email</th>
                                         <th>Image</th>
                                         <th>Action</th>
                                          </thead>
                                          <tbody>';
                                    	if( !empty($users) ) {
                                      foreach ($users as $user) {

                                        
                                        echo '<tr class="odd gradeX">
                                        <td>'.$counter.'</td>
                                        
                                        <td>'.$user['admin_fullname'].'</td>
                                        <td>'.$user['admin_email'].'</td>
                                        <td class="center"><img src="'.base_url().'assets/images/stories/'.$user['admin_pic'].'" alt="no image" class="thumbnail"height="75em" width="75em">'.
                                        '</td>
                                        <td>
                                        <span class="btn-group">
                                            <span class = "btn btn-success "><a href="'.site_url('App/delete_user/'.$user["admin_id"]).'">Remove</a></span>
                                        
                                          </span>
                                         </td>
                                        
                                        </tr>';

                                        $counter++;
                                      }
                                    }
                                    }
                                    
                                    ?>
                                     </tbody>
                                  </table>
											</div>
											<!-- END AVAILABLE USERS TAB -->
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PROFILE CONTENT -->
				</div>
			</div>
                                  </div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
			
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



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
<script src="<?= base_url(); ?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/pages/scripts/profile.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/clockface/js/clockface.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?= base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/admin/pages/scripts/components-pickers.js"></script>

	<!-- END PAGE LEVEL PLUGINS -->
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features\
Profile.init(); // init page demo
ComponentsPickers.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
