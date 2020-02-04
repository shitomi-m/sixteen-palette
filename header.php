<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>"><!-- [ 設定 ] > [ 一般 ] > [ キャッチフレーズ ]を出力 -->

    <title><?php bloginfo( 'title' ); ?></title> <!-- [ 設定 ] > [ 一般 ] > [ サイトのタイトル ]を出力 -->

    <!-- ディスプレイ -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
  <?php wp_head(); ?>  
  </head>
  <body <?php body_class(); ?>>
    <div class="container">
      <header>
        <div class="header-logo">header</div>
        <nav class="header-navi">
          
          <?php
          $args = array (
            'theme_location' => 'place_global',
            'container'      => false,
          );
          wp_nav_menu( $args );
          ?>

        </nav>
      </header>