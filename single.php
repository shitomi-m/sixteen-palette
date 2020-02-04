<?php get_header(); ?>
      <div class="flex-container">
        
        <?php 
        if ( have_posts() ):
          while ( have_posts() ): the_post();
            get_template_part( 'content-single' );
          endwhile;
        endif;
        ?>

        <aside>
          <div class="card sidebar">
            <div class="card-cell">
              <h2>sidebar</h2>
            </div>
          </div>
        </aside>
      </div>
<?php get_footer(); ?>