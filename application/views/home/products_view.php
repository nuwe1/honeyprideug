      
       <section class="events_section_area">
            <h2>HONEY PRIDE PRODUCTS</h2>
            <p>Honey pride has a wide range of products that include but are not limited to the ones listed on this page. For more information feel free to contact us. </p>
            <div class="container">
                <div class="row">
                     <?php 
                                    $counter = 1;
                                    if( !empty($products) ) {
                                      foreach ($products as $product) {

                                       echo '<div class="col-md-4 col-xs-12">
                        <div class="events_single">
                           <img src="'.base_url().'assets/images/products/'.$product['image'].'" alt="no image" >
                            
                            <div class="clear"></div>
                            <h3>'.$product['name'].'</h3>
                            <h6>'.$product['description'].'</h6>
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


 
     

