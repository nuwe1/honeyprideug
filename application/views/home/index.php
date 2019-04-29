        <section class="carosal-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="client owl-carousel owl-theme">
                            <div class="item">
                                <div class="text">
                                    <h3>HONEY PRIDE ARUA (U) LTD</h3>
                                    <p>Honey Pride Arua (U) Ltd was incorporated in September 2015 as a Private Limited Company. It has 100% Ugandan shareholding. The company’s registered Offices are located in Arua. </p>
                                    <h5 class="white-button"><a href="#">FIND OUT MORE</a></h5>
                                    <h5><a href="#">CONTACT US</a></h5>
                                </div>
                            </div>
                            <div class="item">
                                <div class="text">
                                    <h3>OUR BUSINESS</h3>
                                    <p>Honey Pride Arua(U)Ltd is engaged in Agri-business. We are specialized in Apiculture (Bee keeping). We therefore carry out all activities involved bee keeping value chain, i.e.  production, processing, packaging and sale of high quality beehive products.  </p>
                                    <h5 class="white-button"><a href="#">FIND OUT MORE</a></h5>
                                    <h5><a href="#">CONTACT US</a></h5>
                                </div>
                            </div>
                            <div class="item">
                                <div class="text">
                                    <h3>BUSINESS MODEL</h3>
                                    <p>Our Business Model is “Inclusive Business Model”. Here we have included the rural communities at various stages in the value chain. Most importantly, we have included the rural bee keepers as our major suppliers/providers of beehive products – i.e. honey, bees Wax and bee propolis. Our interest is in targeting the youth and women to join this enterprise for sustainable livelihood. Other stages of our inclusion are the processing and later in Sales & Marketing.  </p>
                                    <h5 class="white-button"><a href="#">FIND OUT MORE</a></h5>
                                    <h5><a href="#">CONTACT US</a></h5>
                                </div>
                            </div>
                            <div class="item">
                                <div class="text">
                                    <h3>VISION</h3>
                                    <p> Our vision is “To be a Market leader in the sustainable production, processing and marketing of high quality beehive products in the Great lakes Region”. </p>
                                    <h5 class="white-button"><a href="#">DONATE NOW</a></h5>
                                    <h5><a href="#">CONTACT US</a></h5>
                                </div>
                            </div>
                            <div class="item">
                                <div class="text">
                                    <h3>MISSION</h3>
                                    <p>To provide sustainable economic livelihood and environmental benefits to communities through promotion of apiculture. </p>
                                    <h5 class="white-button"><a href="#">DONATE NOW</a></h5>
                                    <h5><a href="#">CONTACT US</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="our_activity">
            <h2>OUR SERVICES</h2>
            <p>In order to effectively support the rural bee farmer, the following are the services we offer;<br/>
    i. Capacity building through skills training and equipment support.<br/>
    ii. Technical support to bee keepers in good harvest and post-harvest handling practices.<br/>
    iii. Field extension services to address farmers’ day today challenges.<br/>
    iv. Supply of quality modern hives and other equipment needed for modern bee keeping.<br/>
    v. Ready market to rural farmers by buying their products.<br/>
    vi. General Consultancy Services in bee-keeping. </p>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="single-Promo">
                            <div class="promo-icon">
                                <i class="material-icons">near_me</i>
                            </div>
                            <h2><a href="#">Our Products.</a></h2>
                            <p>
    1. liquid honey.<br/>
    2. bees wax.<br/>
    3. bee propolis.<br/>
</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="single-Promo">
                            <div class="promo-icon">
                                <i class="material-icons">favorite</i>
                            </div>
                            <h2><a href="#">Business Concept</a></h2>
                            <p>
    • On a large scale.<br/>
    • Profitably<br/>
    • Sustainably.
 </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="single-Promo">
                            <div class="promo-icon">
                                <i class="material-icons">dashboard</i>
                            </div>
                            <h2><a href="#">Our Core Values</a></h2>
                            <p>
    • Honesty.<br/>
    • Accountability.<br/>
    • Good Service delivery<br/> </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       <section class="donate_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 for-padding">
                        <h4>OUR ENVIRONMENT</h4>
                        <h3>Aproach to Environmental Disasters</h3>
                        <p><?=$environment['content'];?>. </p>
                        
                    </div>
                </div>
            </div>
        </section> 
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
                           <img src="'.base_url().'assets/images/products/'.$product['image'].'" alt="no image" class="thumbnail"height="275em" width="325em">
                            
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
<section class="donate_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 for-padding">
                        <h4>OUR DREAM</h4>
                        <h3>Where we plan to go </h3>
                        <p><?=$dream['content'];?>. </p>
                        <p><?=$vission['content'];?>. </p>
                        <p><?=$mission['content'];?>. </p>
                        
                    </div>
                </div>
            </div>
        </section>
        <section class="our_cuauses">
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
                           <img src="'.base_url().'assets/images/services/'.$service['image'].'" alt="no image"  class="thumbnail"height="275em" width="325em">
                            
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
        <section class="donors">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="donors_input">
                            <h2>WORDS FROM CEO</h2>
                           
            <p style=" margin: 1em;" ><?=$wordsbyceo['content'];?></p>
           
                        </div>
                        <div class="donors_image">
                            <h2>OUR CEO</h2>
                            <div class="donors_featured owl-carousel owl-theme">
                                <div class="item">
                                    <img src="img/donors_featured_one.jpg" alt="">
                                    <h3>Mr. SAM ADERUBO</h3>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
        <div class="clear"></div>
       <section class="volunteer_area">
            <h2>Our Team</h2>
            <p>Honey pride works with a number of individuals. These are some of the individuals that honey pride is proud to work with. </p>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="volunteer_single owl-carousel owl-theme">
                            <?php 
                                    $counter = 1;
                                    if( !empty($teammates) ) {
                                      foreach ($teammates as $teammate) {

                                       echo '
                                       <div class="item">
                                <img src="'.base_url().'assets/images/team/'.$teammate['image'].'"" alt="">
                                <div class="text">
                                    <h3>'.$teammate['name'].'</h3>
                                    <h6>'. $teammate['role'].'</h6>
                                    <p>'.$teammate['description'].'</p>
                                    <h5><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></h5>
                                </div>
                            </div> ';
                            $counter++;
                                      }
                                       }
                                        ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section> 

  <section class="carosal_bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="carosal_bottom_single owl-carousel owl-theme">
                            <?php 
                                    $counter = 1;
                                    if( !empty($story) ) {
                                      foreach ($story as $stori) {

                                        
                                        echo ' <div class="item">
                                <p>'.$stori['content'].'</p>
                                <h5><i class="material-icons">format_quote</i></h5>
                                <h4>'.$stori['name'].'</h4>
                                <h6>'.$stori['title'].'</h6>
                            </div>';

                                        $counter++;
                                      }
                                    }
                                    ?>
                           
                           
                        </div>
                    </div>
                </div>
            </div>
        </section> 
      
        <section class="footer_carosal">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer_carosal_icon owl-carousel owl-theme">
                            <?php 
                                    $counter = 1;
                                    if( !empty($partners) ) {
                                      foreach ($partners as $partner) {

                                        
                                        echo '<div class="item">
                                <img src="'.base_url().'assets/images/partners/'.$partner['logo'].'" alt="'.$partner['name'].'">
                            </div>';

                                        $counter++;
                                      }
                                    }
                                    ?>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>



</html>