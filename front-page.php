<?php get_header(); ?>
      <div class="hero">
        <h1>TOP</h1>
        <div class="image">

        </div>
      </div>
      <div class="search01">
        <h1>search01</h1>
        <!-- searchform.php actionにサイトURI -->
        <form method="get" action="<?php bloginfo( 'url' ); ?>">
          <select name='cat' id='cat' class='postform' >
            <option value='0'>category-select</option>
            <option class="level-0" value="1">-BLOG</option>
            <option class="level-0" value="4">-NEW</option>
          </select>
          <select name='tag' id='tag'>
            <option value="" selected="selected">tag-select</option>
            <option value="tag1">-tag1</option>
            <option value="tag2">-tag2</option>
          </select>
          <!-- name="s" id="s" -->
          <span>キーワード<input name="s" id="s" type="text" />
          <input id="submit" type="submit" value="検索" /></span>
        </form>
      </div>
      <div class="search02">
      <h1>search02</h1>
        <form method="get" action="<?php bloginfo('url'); ?>">
        <!-- 送信ボタンのないセレクトボックス（ドロップダウンメニューなど）を使ったカテゴリーリストを表示します。 -->
        <!-- 引数に$argsを設定可能　下記はクリックすると 'カテゴリーなし' を指定できるテキストのみ指定 -->
          <?php wp_dropdown_categories('show_option_none=カテゴリを選択'); ?>
          <?php $tags = get_tags(); if ( $tags ) : ?>
            <select name="tag">
              <option value="" class="selected">タグを選択</option>
              <?php foreach ( $tags as $tag ): ?>
                <option value="<?php echo esc_html( $tag->slug);  ?>"><?php echo esc_html( $tag->name ); ?></option>
              <?php endforeach; ?>
            </select>
          <?php endif; ?>
            <input name="s" id="s" type="text" placeholder="キーワードを入力">
            <input id="submit" type="submit" value="検索">
        </form>
      </div>

      <div class="index">
        <?php
        // カスタム投稿タイプを指定
        if( get_field('text') ) :
          the_field('text');
          endif;
        
   

        the_field( 'top_title' );

  

        ?>
      </div>

      <ul>
        <li id="test">oooop!!<a herf="#" class="tes">testes</a> </li>
      </ul>
      
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