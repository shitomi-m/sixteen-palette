<?php 

// CSS・Scriptの読み込み
function my_enqueue_scripts(){
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/style.css' );
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

// 親ページ用の画像サイズ設定
// add_image_size( 'parent', 200, 100, true );