          <div class="card blog">
            <div class="card-cell">
              <h2><?php the_title(); ?></h2>
              <p class="date"><?php the_time( 'Y.m.d' ) ?></p>
              <img src="<?php echo get_template_directory_uri(); ?>/images/blog_sample.png" alt="">
              <p>The text will be displayed here.The text will be displayed here.The text will be displayed here.The text will be displayed here.
              The text will be displayed here.The text will be displayed here.The text will be displayed here.The text will be displayed here.
              The text will be displayed here.The text will be displayed here.The text will be displayed here.The text will be displayed here.
              The text will be displayed here.The text will be displayed here.
              </p>
              <a href="<?php the_permalink(); ?>">the_permalink</a>
              <p>get_title is <?php echo get_title(); ?></p>
              <p class="read-more">more...</p>
            </div>        
          </div>