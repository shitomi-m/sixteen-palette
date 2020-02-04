<?php get_header(); ?>
      <div class="hero">
        <h1>Page.php</h1>
        <div class="image">

        </div>
      </div>
      <div class="announce">
        <?php 
        if( have_posts() ):
          while( have_posts() ): the_post();
            the_content();
          endwhile;
        endif;
        ?>
      </div>
      <article>
        <div class="top-one">

        </div>
        <div class="top-two">

        </div>
      </article>
 <?php get_footer(); ?>