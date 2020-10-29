$("#banner-area .owl-carousel").owlCarousel({
  dots: true,
  items: 1,
  loop: true,
  autoplay: true,
  autoplayTimeout: 2500,
  autoplayHoverPause: true,
  smartSpeed: 2000
});

// TOP SALE OWL CAROUSEL
$("#top-rated-movies .owl-carousel").owlCarousel({
  loop: true,
  nav: true,
  dots: false,
  responsive: {
      0: {
          items: 1
      },
      600: {
          items: 3
      },
      1000: {
          items: 5
      }
  }
});

// ANIMATE LOGO

let logo = document.querySelector('a.navbar-brand');

setInterval(() => {
  if(logo.style.color == ""){
      logo.style.color = "#fff";
  }else if(logo.style.color == "rgb(255, 255, 255)"){
      logo.style.color = "#ff0000";
  }else if(logo.style.color == "rgb(255, 0, 0)"){
      logo.style.color = "#fff";
  }
}, 1000);