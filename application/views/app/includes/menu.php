<div class="page-sidebar-wrapper">
     <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
     <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
     <div class="page-sidebar md-shadow-z-2-i  navbar-collapse collapse">
          <!-- BEGIN SIDEBAR MENU -->
          <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
          <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
          <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
          <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
          <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
          <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
          <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
               
              
               <li>
                    <a href="javascript:;">
                    <i class="fa fa-info-circle"></i>
                    <span class="title">About</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                         <li>
                              <a href="<?= site_url('App/About'); ?>">
                                   About US
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/vission'); ?>">
                                   Vission
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/mission'); ?>">
                                   Mision
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/values'); ?>">
                                   Values
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/strategic_plan'); ?>">
                                   Strategic plan
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/words_by_ceo'); ?>">
                                   Words by CEO
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/Business_model'); ?>">
                                   Business model
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/objectives'); ?>">
                                   Objectives
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/our_business'); ?>">
                                   Our Business
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/training_programs'); ?>">
                                   Training programs
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/our_services'); ?>">
                                   Our Service
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/our_environment'); ?>">
                                   Our Enviroment
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/our_dream'); ?>">
                                   Our Dream
                              </a>
                         </li>
                          <li>
                              <a href="<?= site_url('App/our_contact'); ?>">
                                   Our Contact
                              </a>
                         </li>
                         
                   
                    </ul>
               </li>
               <li>
                    <a href="javascript:;">
                    <i class=" fa fa-file"></i>
                    <span class="title">General Attachments</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                         <li>
                              <a href="<?= site_url('App/attachment_add'); ?>">
                              <span class="badge badge-roundless badge-danger">new</span>Add
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/attachment'); ?>">
                              View<br>
                              </a>
                         </li>
                         
                    </ul>
               </li>
               
               <li>
                    <a href="javascript:;">
                    <i class=" fa fa-check-circle"></i>
                    <span class="title">Success stories</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                         <li>
                              <a href="<?= site_url('App/sucessstory_add'); ?>">
                              <span class="badge badge-roundless badge-danger">new</span>Add
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/sucess_story'); ?>">
                              View<br>
                              </a>
                         </li>
                         
                    </ul>
               </li>
               <li>
                    <a href="javascript:;">
                    <i class=" fa fa-file"></i>
                    <span class="title">Products</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                         <li>
                              <a href="<?= site_url('App/products_add'); ?>">
                              <span class="badge badge-roundless badge-danger">new</span>Add
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/products'); ?>">
                              View<br>
                              </a>
                         </li>
                         
                    </ul>
               </li>
                 <li>
                    <a href="javascript:;">
                    <i class=" fa fa-file"></i>
                    <span class="title">Services</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                         <li>
                              <a href="<?= site_url('App/services_add'); ?>">
                              <span class="badge badge-roundless badge-danger">new</span>Add
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/services'); ?>">
                              View<br>
                              </a>
                         </li>
                         
                    </ul>
               </li>   
               <li>
                    <a href="javascript:;">
                    <i class="fa fa-newspaper-o"></i> 
                    <span class="title">Blog</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                         <li>
                              <a href="<?= site_url('App/news_add'); ?>">
                              <span class="badge badge-roundless badge-danger">new</span>Add
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/news'); ?>">
                              View<br>
                              </a>
                         </li>
                         </ul>
                    </li>
                    <li>
                    <a href="javascript:;">
                    <i class="fa fa-video"></i> 
                    <span class="title">Vlog</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                         <li>
                              <a href="<?= site_url('App/video_add'); ?>">
                              <span class="badge badge-roundless badge-danger">new</span>Add
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/videos'); ?>">
                              View<br>
                              </a>
                         </li>
                         </ul>
                    </li>
                      <li>
                    <a href="javascript:;">
                    <i class="fa fa-users"></i> 
                    <span class="title">Team</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                         <li>
                              <a href="<?= site_url('App/team_add'); ?>">
                              <span class="badge badge-roundless badge-danger">new</span>Add
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/team'); ?>">
                              View<br>
                              </a>
                         </li>
                         </ul>
                         </li>
               <li>
                    <a href="javascript:;">
                    <i class="fa fa-handshake"></i> 
                    <span class="title">Partners</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                         <li>
                              <a href="<?= site_url('App/partners_add'); ?>">
                              <span class="badge badge-roundless badge-danger">new</span>Add
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/partners'); ?>">
                              View<br>
                              </a>
                         </li>
                         </ul>
                         </li>
               <li>
                    <a href="javascript:;">
                    <i class="fa fa-image"></i> 
                    <span class="title">Portfolio</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                         <li>
                              <a href="<?= site_url('App/portfolioimages_add'); ?>">
                              <span class="badge badge-roundless badge-danger">new</span>Add
                              </a>
                         </li>
                         <li>
                              <a href="<?= site_url('App/portfolioimages'); ?>">
                              View<br>
                              </a>
                         </li>
                         
                    </ul>
               </li>
          </ul>
          <!-- END SIDEBAR MENU -->
     </div>
</div>
<!-- END SIDEBAR -->
