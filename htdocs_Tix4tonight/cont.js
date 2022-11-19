//total number of element
var elems = document.querySelectorAll('.item');
var n_t = elems.length;
//width of an element
var w = parseInt(document.querySelector('.item').offsetWidth);
//full width of element with margin
var m = document.querySelector('.item').currentStyle || window.getComputedStyle(document.querySelector('.item'));
w = w + parseInt(m.marginLeft) + parseInt(m.marginRight);
//width of container
var w_c = parseInt(document.querySelector('.flex-container').offsetWidth);
//padding of container
var c = document.querySelector('.flex-container').currentStyle || window.getComputedStyle(document.querySelector('.flex-container'));
var p_c = parseInt(c.paddingLeft) + parseInt(c.paddingRight);


var adjust = function(){
   //only the width of container will change
   w_c = parseInt(document.querySelector('.flex-container').offsetWidth);
   //Number of columns
   nb = Math.min(parseInt((w_c - p_c) / w),n_t);
   //Number of rows
   nc = Math.ceil(n_t/nb);
   for(var j = 0;j<nb;j++) {
     for(var i = 0;i<nc;i++) {
       if(j + i*nb >= n_t) /* we exit if we reach the number of elements*/
        break
       if(i%2!=1) 
         elems[j + i*nb].style.order=j + i*nb; /* normal flow */
       else
         elems[j + i*nb].style.order=(nb - j) + i*nb; /* opposite flow */
     }
    }
}

adjust()
window.addEventListener('resize', function(){adjust()})