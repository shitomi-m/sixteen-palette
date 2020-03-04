<?php 

/* 
Template Name: サイドバー有り
*/

get_header();
?>
    <div class="flex-container">
        <article>
          <h1><?php echo get_title(); ?></h1>
          <?php 
          if ( have_posts() ):
            while ( have_posts() ): the_post();
              get_template_part( 'content-archive' );
            endwhile;
          endif;
          ?>

          <div class="pager">
            <ul class="pagenation">
              <li class="prev"><a href="#"><span>PREV</span></a></li>
              <li><a href="#"><span>1</span></a></li>
              <li><a href="#"><span>2</span></a></li>
              <li><a href="#"><span>3</span></a></li>
              <li><a href="#"><span>4</span></a></li>
              <li><a href="#"><span>5</span></a></li>
              <li class="next"><a href="#"><span>NEXT</span></a></li>
            </ul>
          </div>
        </article>
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>