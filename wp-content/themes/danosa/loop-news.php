            <div class="wp-block-column content-list fade-top">
                <a href="<?php the_permalink(); ?>">
                <figure class="wp-block-image size-large content-list-image">
                    <?php danosa_post_thumbnail(); ?>
                </figure>
                </a>
                <div class="wp-block-group">
                    <div class="wp-block-group__inner-container">
                        <h5>News</h5>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php the_excerpt(); ?>
                    </div>
                </div>
                <div class="wp-block-columns">
                    <div class="wp-block-column" style="flex-basis:50%">
                        <a href="<?php the_permalink(); ?>"><?php _e("Read more","danosa"); ?> <i class="danosa-arrow-go"></i></a>
                    </div>
                </div>
            </div>