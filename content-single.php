        <article>
          <h1>Blog</h1>
          <div class="card blog">
            <div class="card-cell">
              <h2><?php the_title(); ?></h2>
              <p class="date"><?php the_time( 'Y.m.d' ); ?></p>
              <img src="<?php get_template_directory_uri(); ?>/assets/images/blog_sample.png" alt="">
              <p><?php the_content(); ?></p>
              <h3>↓get_the_category↓</h3>
              <p><?php print_r( print_get_the_category() ); ?></p>
              <h1><?php echo get_title(); ?></h1>
              <p class="read-more">more...</p>
            </div>        
          </div>
          <div class="more-blog">
            <div class="prev">
              <a href="#"></a>
            </div>
            <div class="next">
              <a href="#"></a>
            </div>
          </div>
        </article>
