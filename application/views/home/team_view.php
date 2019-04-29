        <section class="our_cuauses">
            <h2>OUR TEAM</h2>
            <p>Team Honey Pride Arua led by the Technical Director, Mr. Alli, accompanied by the<br/> Coordinator, Training & Capacity Building, Mr.Robert Angudubo, participate in routine hive cleaning exercise in our Apiary in Lazebu.<br/></p>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="our_cuauses_single owl-carousel owl-theme">
                            
                            <?php 
                                    $counter = 1;
                                    if( !empty($teammates) ) {
                                      foreach ($teammates as $teammate) {

                                       echo ' <div class="item">
                                       <img src="'.base_url().'assets/images/team/'.$teammate['image'].'" alt="no image" class="thumbnail">
                                <div class="for_padding">
                                    <h2>'.$teammate['name'].' -- '. $teammate['role'].'</h2>
                                    <p>'.$teammate['description'].'</p>
                                    
                                </div>
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

    
     