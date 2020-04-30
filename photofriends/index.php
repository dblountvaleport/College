<?php
include 'core/init.php';
include 'includes/overall/header.php';
?>

<h1>Home Page</h1>

<?php
if (logged_in() === true) {
    include 'includes/widgets/profile_search.php';
    include 'includes/widgets/upload_image.php';
}
?>

<?php include 'includes/overall/footer.php';?>