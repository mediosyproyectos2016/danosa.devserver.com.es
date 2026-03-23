            <?php

            $image_list = get_field("image_list");
            $country = get_field("country");
            $province = get_field("province");
            $products = get_field("products");
            ?>
            <div class="wp-block-column content-list fade-top">
                <figure class="wp-block-image size-large content-list-image">
                    <a href="<?php the_permalink(); ?>"><img width="352" height="176" src="<?php echo $image_list; ?>" class="attachment-danosa-news-list size-danosa-news-list wp-post-image" alt="" loading="lazy" sizes="(max-width: 352px) 100vw, 352px"></a>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </figure>
                <div class="wp-block-group">
                    <div class="wp-block-group__inner-container">
                        <p class="content-list-materials">
                            <?php _e("Materials used","danosa"); ?>:


                            <?php
                            if(!empty($products)){
                                ?>
                                <?php
                                $products = explode(",", $products);

                                $products = array_map("sanitize_title", $products);

                                $args = array(
                                  'post_type'       => 'product',
                                  'post_name__in'        => $products
                                );
                                $the_query  = new WP_Query( $args );


                                // The Loop
                                if ( $the_query->have_posts() ) {
                                    while ( $the_query->have_posts() ) {
                                        $the_query->the_post();
                                        ?>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>,

                                        <?php

                                    }

                                } else {
                                    // no posts found
                                }
                                /* Restore original Post Data */
                                wp_reset_postdata();
                            }
                            ?>

                            </p>
                        <p class="content-list-location">
                            <?php
                                if(!empty($country)){
                                    ?>
                                    <i class="danosa-map"></i>
                                    <?php
                                    if(!empty($province)){
                                        ?>
                                        <?php
                                        echo $province." - ";
                                    }
                                    echo get_country_name_by_iso($country)."<br>";

                                }
                            ?>
                    </div>
                </div>
            </div>