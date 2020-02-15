<?php get_header(); ?>
      <div class="hero">
        <h1>TOP</h1>
        <div class="image">

        </div>
      </div>
      <div class="announce">
        <h2>announce</h2>
        <div class="announce-content">
          <p class="date">2020/02/20</p>
          <h3>announce-title</h3>
          <p class="texrt">announce text.announce text.announce text.announce text.announce text.</p>
        </div>
        <div class="announce-content">
          <p class="date">2020/02/20</p>
          <h3>announce-title</h3>
          <p class="texrt">announce text.announce text.announce text.announce text.announce text.</p>
          <a class="post-link" href="#">post-link</a>
        </div>
      </div>
      <article>
        <div class="parent-h">
          
          <?php 
          $obj = get_page_by_path( 'parent' );
          print_r( $obj );
          $post = $obj;
          setup_postdata( $post );
          ?>

          <h2>set_up:: <?php the_title(); ?></h2>
          <h2>TITLE -> <?php echo $post->post_title; ?></h2>
          <p>EXCERPT -> <?php echo $post->post_content; ?></p>
          <p><a href="<?php echo $post->guid; ?>">PERMALINK -> <?php echo $post->guid; ?></a></p> 

          <?php wp_reset_postdata(); ?>

        </div>
        <div class="children-h">
          
          <?php
          $parent_id = $obj->ID;
          $args = array(
            'post_per_page' => 1,
            'post_type'     => 'page',
            'orderby'       => 'menu_order',
            'order'         => 'ASC',
            'post_parent'   => $parent_id,
          );

          $child_pages = new WP_Query( $args );
          if ( $child_pages->have_posts() ):
            while ( $child_pages->have_posts() ): $child_pages->the_post();
          ?>

          <h3>title--> <?php the_title(); ?></h3>
          <p>excerpt--> <?php echo get_the_excerpt(); ?></p>
          <p>permalink--> <?php echo get_the_permalink(); ?><a href="<?php get_the_permalink(); ?>"></a></p>

          <?php
            endwhile;
            wp_reset_postdata();
          endif;
          ?>

          <h2>▼ Parent List Link ▼</h2>
          <p>▼<br>▼<br>▼<br>▼<br>▼<br>▼<br></p>
          
          <?php 
          // esc_url   URLを無害化する。ホワイトリストに登録されているプロトコル意外のuRLを拒絶するなどして、
          //           セキュリティ上のリスクを回避する

          // home_url   現在のホームURLを返す。ホームからの相対パスを引数に指定することができる
          ?>          
          <p><a href="<?php echo esc_url( home_url( 'parent' ) ) ?>">Go</a></p>
          
        </div>
      </article>
 <?php get_footer(); ?>