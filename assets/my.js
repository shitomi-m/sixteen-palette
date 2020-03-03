'use-strict';

console.log ( 'Hello js' );

// window.onload = function(){

// console.log ( 'Hello js' );

// let gNav_parent = document.getElementById('menu-item-34');

// gNav_parent.onclick = function(){
//     console.log('ok');
//     // let subMenu = getElementByClassname( 'sub-menu' );
//     // subMenu.className.add( 'show' );
// }

// }

// window.onload = function(){
//     let gNav_parent = document.getElementById('menu-item-34');
//     function showMenu (){
//         // let subMenu = getElementByClassname( 'sub-menu' );
//         // subMenu.className.add( 'show' ); 
//         console.log('test_OK');
//      }
//      gNav_parent.addEventListener( 'click', showMenu )
// }

window.onload = function(){

    // 親を取得
    let gNav_parent = document.getElementById( 'menu-item-34' );
    // 子要素を取得
    let subMenu = gNav_parent.children;
    
    // htmlコレクションを表示
    console.log( subMenu );
    // htmlコレクション1のulのクラスネーム、0はaタグ
    console.log( subMenu[1].className );
    
    function showMenu (){
        let hav_show = subMenu[1].classList.contains('show');
        console.log(hav_show);
        if ( hav_show ){
            subMenu[1].classList.remove( 'show' );
        } else {
            subMenu[1].classList.add( 'show' );
        }
    }
    gNav_parent.addEventListener( 'mouseenter', showMenu, false )
}

// window.addEventListener('load', function() {
//     let gNav_parent = document.getElementById('menu-item-34');
//     gNav_parent.onclick = function(){
//        let subMenu = getElementByClassname( 'sub-menu' );
//        subMenu.className.add( 'show' ); 
//     }
// })

