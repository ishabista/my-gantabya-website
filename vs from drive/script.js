let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
     menu.classList.toggle('fa-times');
     navbar.classList.toggle('active');


};
window.scroll= () =>{
     menu.classList.remove('fa-times');
     navbar.classList.remove('active');
}
var swiper = new swiper(".home-slider", {
     loop:true,
     navigation: {
          nextE1: ".swiper-button-next",
          prevE1: ".swiper-button-prev",
     },
     });

     var swiper = new swiper(".reviews-slider", {
          grabcursor:true,
          loop:true,
          autoHeight:true,
          spaceBetween:20,
          breakpoints: {
               0: {
                    slidesPerView: 1,
               },
               700: {
                    slidesPerView: 2,
               },
               1000: {
                    slidesPerView: 3,
               },        },
     });


     letloadMoreBtn =document.querySelector('.packages .load-more .btn');
     let currentItem=3;

     loadMoreBtn.onclick =() =>{
          let boxes =[...document.querySelectorAll('packages .box-container .box')];
          for (var i = currentItem; i < currentItem + 3; i++){
               boxes[i].style.display = 'inline-block';
          };
          currentItem += 3;
          if(currentItem >=boxes.length){
               loadMoreBtn.style.display = 'none';
          
     }
}