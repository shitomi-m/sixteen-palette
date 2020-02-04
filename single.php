<?php get_header(); ?>
      <div class="flex-container">
        <article>
          <h1>Blog</h1>

          <?php 
          if ( have_posts() ):
            while ( have_posts() ): the_post();
          ?>

          <div class="card blog">
            <div class="card-cell">
              <h2><?php the_title(); ?></h2>
              <p class="date"><?php the_time( 'Y.m.d' ); ?></p>
              <img src="<?php get_template_directory_uri();  ?>/images/blog_sample.png" alt="">
              <p><?php the_content(); ?></p>
              <p><?php print_r( print_get_the_category() ); ?></p>
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

          <?php 
            endwhile;
          endif;
          ?>

        </article>
        <aside>
          <div class="card sidebar">
            <div class="card-cell">
              <h2>sidebar</h2>
            </div>
          </div>
        </aside>
      </div>
<?php get_footer(); ?>