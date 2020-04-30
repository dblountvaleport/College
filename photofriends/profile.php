<?php
include 'core/init.php';
include 'includes/overall/header.php';

if (logged_in() === true) {
    if (isset($_GET['username']) === true && empty($_GET['username']) === false) {
        $username = $_GET['username'];

        global $session_user_id;

        if (user_exists($username) === true) {
            $user_id = user_id_from_username($username);
            $profile_data = user_data($user_id, 'first_name', 'last_name', 'email', 'profile', 'privacy', 'type', 'title', 'description');
            if (has_access($session_user_id, 1) === true) {
                include 'includes/widgets/profile_content.php';
            } else {
                if (has_access($session_user_id, 2) === true) {
                    include 'includes/widgets/profile_content.php';
                } else {
                    if ($profile_data['privacy'] === "0") {
                        include 'includes/widgets/profile_content.php';
                    } else {
                        echo 'Sorry, that user has set their profile to private.';
                    }
                }
            }
        } else {
            echo 'Sorry, that user doesn\'t exist.';
        }
    } else {
        header('Location: index.php');
        exit();
    }
} else {
  header('Location: index.php');
  exit();
}
include 'includes/overall/footer.php';
?>