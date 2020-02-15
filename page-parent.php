<?php get_header(); ?>
      <div class="flex-container">
        <article>
          <h1>parent</h1>
          <h2>get_post_ID</h2>
          <?php 

          //サブクエリを使用: テンプレート内で指定して呼び出される記事データ

          $parent_id = get_the_ID();            //現在表示している記事のIDを取得
          $args = array(
            'post_per_page' => -1,              //取得したい記事数　-1：全件取得
            'post_type'     => 'page',          //取得したい投稿タイプ　page：固定ページ
            'orderby'       => 'menu_order',    //並べ替えの基準　menu_order　menu_order：管理画面で設定した並び順（120とか）
            'order'         => 'ASC',           //降順か昇順か
            'post_parent'   =>  $parent_id,      //親ページの記事IDを指定し、その親に紐づく子ページの情報を取得する。表示したい子ページの親IDを指定
          );
      
          //サブクエリ
          $common_pages = new WP_Query($args); 
          if ( $common_pages->have_posts() ):
            while ( $common_pages->have_posts() ): $common_pages->the_post();
          ?>

          <ul>
            <li>title：<?php the_title(); ?></li>
            <li>permalink：<?php the_permalink(); ?></li>
            <li>excerpt：<?php echo get_the_excerpt(); ?></li>
          </ul>
          <div class="common-img"><?php the_post_thumbnail( 'child' ); ?></div>

          <?php  wp_reset_postdata();      //メインクエリに戻す
            endwhile;
          endif;
          ?>  

          <?php 
          $children = wp_list_pages('title_li=&child_of='. $post->ID. '&echo=0');
          echo $post->ID;
          if ( $children ): ?>

          <ul>
            <?php echo $children; ?>
          </ul>
      
          <?php endif; ?>
          
          <hr>
          <h2>get_page_by_path</h2>

          <?php 

          // get_page_by_path( 'スラッグ' )               固定ページのスラッグを指定して、オブジェクトを取得する
          // get_page_by_path( '親スラッグ/子スラッグ' )    子ページの情報を取得したい場合
          $obj = get_page_by_path( 'parent' );
          $post = $obj;
          
          // 投稿情報を各種のグローバル変数へセット（戻すのを忘れない！）
          // その変数は、テンプレートタグを使ってカスタムクエリの結果を表示するときに使われる
          // 引数は必ず　＄post にする！！　他の名前は使えない
          setup_postdata( $post );
          $title = get_the_title();  // 戻した後に使いものはここで変数にしまう

          ?>
          
          <div>
            TITLE: <?php the_title(); ?> </br>
            EXCERPT: <?php echo get_the_excerpt(); ?>
          </div>

          <?php wp_reset_postdata(); ?>

          <hr>
          <h2>after wp_reset_postdata</h2>
          <p>echo: <?php echo $title; ?></p>

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