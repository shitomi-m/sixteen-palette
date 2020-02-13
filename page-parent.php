<?php get_header(); ?>
      <div class="flex-container">
        <article>
          <h1>parent</h1>
         
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
          <div class="common-img"><?php the_post_thumbnail(  ); ?></div>

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