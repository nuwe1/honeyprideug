      
       <section class="events_section_area">
            <h2>HONEY PRIDE SERVICES</h2>
            <p>Honey pride offers a wide range services, just like products,  that include but are not limited to the ones listed on this page. For more information feel free to contact us. </p>
            <div class="container">
                <div class="row">
                     <?php 
                                    $counter = 1;
                                   if( !empty($services) ) {
                                      foreach ($services as $service) {

                                       echo '<div class="col-md-4 col-xs-12">
                        <div class="events_single">
                           <img src="'.base_url().'assets/images/services/'.$service['image'].'" alt="no image" >
                            
                            <div class="clear"></div>
                            <h3>'.$service['name'].'</h3>
                            <h6>'.$service['description'].'</h6>
                        </div>
                    </div>
                    ';
                            $counter++;
                                      }
                            }
                          ?>
                    
                   
                </div>
            </div>
        </section> 


 
     

