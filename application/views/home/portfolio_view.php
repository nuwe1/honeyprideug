 
       <section class="events_section_area">
            <h2>GALLERY</h2>
            <p>Honey Pride Arua(U)Ltd(HPA)was incorporated in September 2015. The Company has one hundred percent Ugandan shareholding.  </p>
            <div class="container">
                <div class="row">
                    <?php 
                                    $counter = 1;
                                    if( !empty($images) ) {
                                      foreach ($images as $image) {

                                       echo '<div class="col-md-4 col-xs-12">
                        <div class="events_single">
                            <img src="'.base_url().'assets/images/stories/'.$image['image_link'].'" alt="">
                            <div class="clear"></div>
                        </div>
                    </div>';
                            $counter++;
                                      }
                            }
                          ?>
                    
                    
                    
                </div>
            </div>
        </section> 

        
      