<?php 
    include_once 'classes/Movie.php';
    include_once 'classes/Rating.php';

    $movies = Movie::getAll();
    shuffle($movies);

    $moviesSortedByDate = Movie::sortByDate();

 ?>

<?php include 'includes/header.php' ?>
<?php include 'includes/owlcarousel.php' ?>
<?php include 'includes/messages.php' ?>
<?php include 'includes/top_rated_movies.php' ?>
<?php include 'includes/movies.php' ?>
<?php include 'includes/newest_movies.php' ?>
<?php include 'includes/movie_modal.php' ?>
<?php include 'includes/footer.php' ?>
