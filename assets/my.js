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

// クラスをつけたり消したりする関数
window.onload = function(){

    // ホバーした要素がmenu-item-has-childrenを検索（下層ページを持つ要素全てに対応）
    let gNav_parent = document.getElementsByClassName( 'menu-item-has-children' );
    console.log( gNav_parent );
    
    // menu-item-has-children
    for (let i = 0; i < gNav_parent.length; i++) {
        // thisはホバーされたオブジェクト
        gNav_parent[i].addEventListener( 'mouseenter', () => {
            let children = this.children;
            console.log(children)

            let hav_show = children[1].classList.contains( 'show' );
            if ( hav_show ){
                children[1].classList.remove( 'show' );
            } else {
                children[1].classList.add( 'show' );
            }
        })
    }

}

// window.addEventListener('load', function() {
//     let gNav_parent = document.getElementById('menu-item-34');
//     gNav_parent.onclick = function(){
//        let subMenu = getElementByClassname( 'sub-menu' );
//        subMenu.className.add( 'show' ); 
//     }
// })

