       <section class="letast_news">
            <h2>latest news</h2>
            <p>Honey Pride Arua is a company engaged in farming. We specialize in Apiculture. Apiculture is the branch of agriculture that deals with BEE KEEPING.  </p>
            <div class="container">
                <div class="row">
                    <?php 
                                    $counter = 1;
                                     if( !empty($news) ) {
                                      foreach ($news as $new) {

                                       echo '<div class="col-md-4">
                        <div class="single_news">
                           <img src="'.$new['image_link'].'" alt="">
                            <div class="texts">
                                <p class="date"><a href="'.site_url('Home/blogItem/'.$new["id"]).'">'.$new['date'].'</a></p>
                                <h3>'.$new['headline'].'<br> '.$new['author'].'</h3>
                                <p class="test">'.$new['description'].'</p>
                                <h3><a href="'.site_url('Home/blogItem/'.$new["id"]).'">READ MORE</a></h3>
                            </div>
                        </div>
                    </div>';
                            $counter++;
                                      }
                            }
                          ?>
                    
                    
                    
                    
                </div>
            </div>
        </section> 

    


        