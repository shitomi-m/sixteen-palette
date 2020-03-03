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
    let gNav_parent = document.getElementById( 'menu-item-34' );
    let subMenu = gNav_parent.children;
    
    console.log( subMenu );
    console.log( subMenu[1].className );
    
    function showMenu (){
        subMenu[1].classList.add( 'show' );
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

