<?php
include 'core/init.php';
include 'includes/overall/header.php';
?>

<h1>Map</h1>

<?php
if (logged_in() === true) {
    include 'includes/widgets/display_map.php';
}
?>

<?php include 'includes/overall/footer.php';?>