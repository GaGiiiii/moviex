$("#banner-area .owl-carousel").owlCarousel({
  dots: true,
  items: 1,
  loop: true,
  autoplay: true,
  autoplayTimeout: 2500,
  autoplayHoverPause: true,
  smartSpeed: 2000
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