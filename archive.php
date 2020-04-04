<?php get_header(); ?>
      <div class="flex-container">
        <article>
          <h1>Blog</h1>
          <?php 
          if ( have_posts() ):
            while ( have_posts() ): the_post();
              get_template_part( 'content-archive' );
            endwhile;
          endif;
          ?>

          <div class="pager">
            <ul class="pagenation">
              <!-- プラグインを使ったページャー -->
              <!-- <?php 
              if (function_exists( 'page_navi' )):
                page_navi();
              endif;
              ?> -->

              <?php 
                global $wp_query;

                $args = array(
                  'bace'        => 'http://example.com/all_posts.php%_%',
                  'format'      => '?paged=%#%',
                  'current'     => max( 1, get_query_var('paged') ),
                  'total'       => $wp_query->max_num_pages,
                  'mid_size'    => 2,
                  'prev_text'   => '<< prev',
                  'next_text'   => 'next >>',
                  'type'        => 'list',
                );
                echo paginate_links( $args );
                
                // 簡単な方
                // $args = array(
                //   'mid_size'    => 2,
                //   'prev_text'   =>  '<< prev',
                //   'next_text'   => 'next >>',
                //   'screen_reader_text'    => 'ページャー',
                // );
                // the_posts_pagination( $args );
              ?>

            </ul>
          </div>
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