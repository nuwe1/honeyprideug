       <section class="letast_news">
            <h2>latest videos</h2>
            <p>Honey Pride Arua is a company engaged in farming. We specialize in Apiculture. Apiculture is the branch of agriculture that deals with BEE KEEPING.  </p>
            <div class="container">
                <div class="row">
                    <?php 
                                    $counter = 1;
                                     if( !empty($videos) ) {
                                      foreach ($videos as $video) {

                                       echo '
                          '.$video['video_link'].'
                            ';
                            $counter++;
                                      }
                            }
                          ?>
                    
                    
                    
                    
                </div>
            </div>
        </section> 

    


        