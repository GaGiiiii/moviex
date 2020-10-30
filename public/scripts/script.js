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
  if (logo.style.color == "") {
    logo.style.color = "#fff";
  } else if (logo.style.color == "rgb(255, 255, 255)") {
    logo.style.color = "#ff0000";
  } else if (logo.style.color == "rgb(255, 0, 0)") {
    logo.style.color = "#fff";
  }
}, 1000);

// ADMIN


let cardsAdmin = document.querySelectorAll('.card-admin');
let invisible = document.querySelectorAll('.invis');

cardsAdmin.forEach(card => {
  card.addEventListener('mouseover', (event) => {
    let index = event.currentTarget.getAttribute("data-index");
    invisible[index].classList.remove("invis");
  });

  card.addEventListener('mouseout', (event) => {
    let index = event.currentTarget.getAttribute("data-index");
    invisible[index].classList.add("invis");
  });

  card.addEventListener('click', (event) => {
    console.log("click");
  });
});

// SORT

let sortButtons = document.querySelectorAll(".sort-btn");
let searchInput = document.querySelector(".search-input");

sortButtons.forEach((sortButton) => {
  sortButton.addEventListener('click', (event) => {
    let sortType = sortButton.dataset.sortType;

    $.ajax({
      url: 'sort.php',
      type: 'POST',
      data: {
        sortType
      },
      success: (movies) => {
        let output = "";
        movies = JSON.parse(movies);
        console.log(movies)

        movies.forEach((movie) => {
          output += `<div class="col-md-4">
          <div class="item text-center border p-3">
            <img src="${movie.img}" alt="Banner1" data-toggle="modal" data-target="#movie-modal${movie.id}">
            <h3 class="text-center movie-title mt-3">${movie.title}</h3>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
          </div>
        </div>`;
        });

        document.querySelector(".movies-div").innerHTML = output;
      }
    });
  });
});

searchInput.addEventListener('keyup', (event) => {
  let searchText = event.target.value;

  $.ajax({
    url: 'search.php',
    type: 'POST',
    data: {
      searchText,
    },
    success: (movies) => {
      let output = "";
      movies = JSON.parse(movies);
      console.log(movies)

      movies.forEach((movie) => {
        output += `<div class="col-md-4">
        <div class="item text-center border p-3">
          <img src="${movie.img}" alt="Banner1" data-toggle="modal" data-target="#movie-modal${movie.id}">
          <h3 class="text-center movie-title mt-3">${movie.title}</h3>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="far fa-star"></i>
        </div>
      </div>`;
      });

      document.querySelector(".movies-div").innerHTML = output;
    }
  })
});

// STARTS

let stars = document.querySelectorAll(".star");
let movieRatingSpans = document.querySelectorAll('.movie-rating');
let userRatingSpans = document.querySelectorAll('.user-rating');


stars.forEach((star) => {

  star.addEventListener('mouseover', (event) => {
    let rating = star.dataset.rating;
    let movieID = star.dataset.movieId;

    stars.forEach((star2) => {
      let rating2 = star2.dataset.rating;
      let movieID2 = star2.dataset.movieId;

      if (movieID2 == movieID) {
        if (rating2 <= rating) {
          star2.classList.add('text-warning');
        } else {
          star2.classList.remove('text-warning');
        }

      }
    });
  });

  star.addEventListener('mouseout', (event) => {
    let rating = star.dataset.rating;
    let movieID = star.dataset.movieId;

    stars.forEach((star2) => {
      let rating2 = star2.dataset.rating;
      let movieID2 = star2.dataset.movieId;

      if (movieID2 == movieID) {
        if (!star2.classList.contains("voted")) {
          star2.classList.remove('text-warning');
        } else {
          star2.classList.add('text-warning');
        }
      }
    });
  });

  star.addEventListener('click', (event) => {
    let rating = star.dataset.rating;
    let movieID = star.dataset.movieId;
    let userID = star.dataset.userId;

    emptyStarts(movieID);

    stars.forEach((star2) => {
      let rating2 = star2.dataset.rating;
      let movieID2 = star2.dataset.movieId;

      if (movieID2 == movieID && rating2 <= rating) {

        star2.classList.add('text-warning');
        star2.classList.add('voted');
      }
    });

    $.ajax({
      url: 'rate.php',
      type: 'POST',
      data: {
        movieID,
        userID,
        rating,
      },
      success: (updatedRating) => {
        movieRatingSpans.forEach((movieRatingSpan) => {
          let movieIDSpan = movieRatingSpan.dataset.movieId;

          if(movieIDSpan == movieID){
            movieRatingSpan.innerHTML = updatedRating;
          }
        });

        userRatingSpans.forEach((userRatingSpan) => {
          let movieIDSpan = userRatingSpan.dataset.movieId;

          if(movieIDSpan == movieID){
            userRatingSpan.innerHTML = rating;
          }
        });
      }
    })


  });

});

function emptyStarts(movieID) {
  stars.forEach((star) => {
    let movieID2 = star.dataset.movieId;

    if (movieID2 == movieID) {
      star.classList.remove('text-warning');
      star.classList.remove('voted');
    }
  });
}




