<?php 

// CSS・Scriptの読み込み
function my_enqueue_scripts(){
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/style.css', array() );
    // wp_enqueue_style( 'print-style', get_template_directory_uri() . '/assets/print.css', array( 'main-style' ), false, 'print' );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/my.js', array() );
}

// add_action( 
//     $tag:アクションフック名, 
//     $function_to_add:アクションフックが適用された時に差し込む関数名, 
//     [ $priority:実行の優先順位(指定したアクションフックに関連したなかでの), $accepted_args:フックした関数が受け取る引数 ] 
//     )
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts' );


// カスタムメニュー機能の有効化（WP標準）
// key：    カスタムメニューを使用する場所をテンプレート内で指定するための名前
// value:   管理画面上にメニューの一として表示される
register_nav_menus(
    array (
        'place_global' => 'グローバル',
        'place_footer' => 'フッターナビ',
    )
);


// カテゴリーの中身を表示
// get_the_category()   カテゴリー情報をオブジェクトの配列形式で取得する。引数で投稿IDを指定できる
// is_singular()        個別の投稿を表示中かを判定。引数で判定する投稿タイプを指定できる
// is_page()            固定ページを表示中かを判定
function print_get_the_category(){
    $category_obj = get_the_category();
    for ($i=0; $i < count( $category_obj ); $i++) { 
        return $category_obj[$i];
    }
}


// タイトルの表示
// 投稿[post]の時はカテゴリー名を取得
// カテゴリー一覧ページの時は現在のカテゴリーを出力
function get_title(){
    if ( is_singular( 'post' ) ){
        $category_obj = get_the_category();
        return $category_obj[0]->name;
    } elseif ( is_category() ){
        return single_cat_title();
    } 
    else {
        return get_the_title();
    }
}

// アイキャッチ画像を利用できるように設定　※ハイフン！！
add_theme_support( 'post-thumbnails' );

// 画像のサイズを設定
add_image_size( 'child', 300, 100, true );

add_image_size( 'page', 400, 200, true );

// 画像を出力する関数の作成
// 固定ページで呼び出された時は、add_image_size　'page' で設定したサイズで出力(登録は管理画面から)
// カテゴリーがブログか、記事の個別ページの場合はassetsに入っている画像のURLを出力して表示
function get_main_img(){
    if ( is_page() ){
        return get_post_thumbnail( 'page' );
    } elseif ( is_home() ){
        return '<img src="' . get_template_directory_uri() . 'assets/images/home.png" />';
    } elseif ( is_category( 'blog' ) || is_singular( 'post' ) ){
        return '<img src="' . get_template_directory_uri() . 'assets/images/blog.png" />';
    }
}

// All in One Sub Navi Wedgetの機能を有効化
function theme_widgets_init(){
    $args = array(
        'name'          =>  'サイドバー用',                 // 管理画面に表示される
        'id'            =>  'side-bar-area',          // ウィジットエリアのID　呼び出しに必要
        'description'   =>  '固定ページのサイドバー',       // ウィジットエリアの説明　管理画面に表示される
        'before_widget' =>  '<div class="card-cell">',  //ウィジットの前後に出力するテキスト
        'after_widget'  =>  '</div>',
        'before_title'  =>  '<h3>',                     // タイトルの前後に出力されるテキスト
        'after_title'   =>  '</h3>',
    );
    register_sidebar( $args );
}
add_action( 'widgets_init', 'theme_widgets_init' );


/**
 * Adds Foo_Widget widget.
 */
class Mk_Link_Widget extends WP_Widget {

	/**
	 * WordPress でウィジェットを登録
	 */
	function __construct() {
		parent::__construct(
			'mk_link_widget', // Base ID
			__( 'TOPリンク集　作成用', 'top_links' ), // Name
			array( 'description' => __( 'ウィジェット「TOPリンク集　作成用」です。', 'top_links' ), ) // Args
		);
	}

	/**
	 * バックエンドのウィジェットフォーム
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance データベースからの前回保存された値
	 */
	public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'top_links' );
        $link_url = ! empty( $instance['link_url'] ) ? $instance['link_url'] : __( '', 'top_links' );
        $link_img = ! empty( $instance['link_img'] ) ? $instance['link_img'] : __( '', 'top_links' );
        
		?>
		<p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'タイトル:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'link_url' ); ?>"><?php _e( 'URL:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'link_url' ); ?>" name="<?php echo $this->get_field_name( 'link_url' ); ?>" type="text" value="<?php echo esc_attr( $link_url ); ?>">
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'link_img' ); ?>"><?php _e( '画像:' ); ?></label> 
            <input class="fixed-image-url" id="<?php echo $this->get_field_id('link_img'); ?>" name="<?php echo $this->get_field_name('link_img'); ?>" type="text" value="<?php echo $link_img; ?>">
            <button type="button" class="fixed-select-image">画像を選択</button>
            <button type="button" class="fixed-delete-image" <?php echo $show_img; ?>>画像を削除</button>
            <!-- <input name="mediaid" type="text" value="" />
            <input type="button" name="media" value="選択" />
            <input type="button" name="media-clear" value="クリア" /> -->
            <div id="media"></div>
        </p>

        <!-- メディアライブラリを使う -->
        <script>
      jQuery(document).ready(function($) {

        var frame;
        const placeholder = jQuery('.fixed-image-text');
        const imageUrl = jQuery('.fixed-image-url');
        const imageView = jQuery('.fixed-image-view');
        const deleteImage = jQuery('.fixed-delete-image');

        jQuery('.fixed-select-image').on('click', function(e){
          e.preventDefault();

          if ( frame ) {
            frame.open();
            return;
          }

          frame = wp.media({
            title: '画像を選択',
            library: {
              type: 'image'
            },
            button: {
              text: '画像を追加する'
            },
            multiple: false
          });

          frame.on('select', function(){
            var images = frame.state().get('selection');
            images.each(function(file) {
              placeholder.css('display', 'none');
              imageUrl.val(file.toJSON().url);
              imageView.attr('src', file.toJSON().url).css('display', 'block');
              deleteImage.css('display', 'inline-block');
            });
            imageUrl.trigger('change');
          });

          frame.open();
        });

        jQuery('.fixed-delete-image').off().on('click', function(e){
          e.preventDefault();
          imageUrl.val('');
          imageView.css('display', 'none');
          deleteImage.css('display', 'none');
          imageUrl.trigger('change');
        });

      });
    </script>
        <!-- <script>
            (function ($) {
        
                var custom_uploader;

                $("input:button[name=media]").click(function(e) {

                    e.preventDefault();

                    if (custom_uploader) {
                        custom_uploader.open();
                        return;
                    }

                    custom_uploader = wp.media({
                        title: "Choose Image",
                        /* ライブラリの一覧は画像のみにする */
                        library: {
                            type: "image"
                        },
                        button: {
                            text: "Choose Image"
                        },
                        /* 選択できる画像は 1 つだけにする */
                        multiple: false
                    });

                    custom_uploader.on("select", function() {
                        var images = custom_uploader.state().get("selection");
                        /* file の中に選択された画像の各種情報が入っている */
                        images.each(function(file){
                            /* テキストフォームと表示されたサムネイル画像があればクリア */
                            $("input:text[name=mediaid]").val("");
                            $("#media").empty();
                            /* テキストフォームに画像の ID を表示 */
                            $("input:text[name=mediaid]").val(file.id);
                            /* プレビュー用に選択されたサムネイル画像を表示 */
                            $("#media").append('<img src="'+file.attributes.sizes.thumbnail.url+'" />');
                        });
                    });
                    custom_uploader.open();
                });

                /* クリアボタンを押した時の処理 */
                $("input:button[name=media-clear]").click(function() {
                    $("input:text[name=mediaid]").val("");
                    $("#media").empty();
                });
            })(jQuery);
        </script> -->
		<?php 
    }
    
    /**
	 * ウィジェットのフロントエンド表示
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     ウィジェットの引数
	 * @param array $instance データベースの保存値
	 */
	public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'top_links' );
        $link_url = ! empty( $instance['link_url'] ) ? $instance['link_url'] : __( '', 'top_links' );
        $link_img = ! empty( $instance['link_img'] ) ? $instance['link_img'] : __( '', 'top_links' );

        // ウィジェットエリアの定義（開始タグ）
        echo $args['before_widget'];
        
        // 表示内容
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
        if ( ! empty( $instance['link_url'] ) ) {
            echo '<a href="' . $instance['link_url'] . '">' . $instance['link_url'] . '</a>';
        }
        if ( ! empty( $instance['link_img'] ) ) {
            echo '<img src="' . $link_img . '" />';
        }else{
            echo $link_img;
        }

        // ウィジェットエリアの定義（終了タグ）
		echo $args['after_widget'];
	}

	/**
	 * ウィジェットフォームの値を保存用にサニタイズ
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance 保存用に送信された値
	 * @param array $old_instance データベースからの以前保存された値
	 *
	 * @return array 保存される更新された安全な値
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['link_url'] = ( ! empty( $new_instance['link_url'] ) ) ? strip_tags( $new_instance['link_url'] ) : '';
        $instance['link_img'] = ( ! empty( $new_instance['link_img'] ) ) ? strip_tags( $new_instance['link_img'] ) : '';
        
		return $instance;
	}

} // class Mk_Link_Widget

// Mk_Link_Widget ウィジェットを登録
function register_mk_link_widget() {
    register_widget( 'Mk_Link_Widget' );
}
add_action( 'widgets_init', 'register_mk_link_widget' );