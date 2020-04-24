<?php
function logged_in_redirect() {
    if (logged_in() === true) {
            header('Location: index.php');
            exit();
        }
}

function protect_page() {
    if (logged_in() === false) {
        header('Location: protected.php');
        exit();
    }
}

function admin_protect() {
global $session_user_id;
    if (has_access($session_user_id, 1) === false) {
        header('Location: index.php');
        exit();
    }
}

function moderator_protect() {
global $session_user_id;
    if (has_access($session_user_id, 2) === false) {
        header('Location: index.php');
        exit();
    }
}

function array_sanitize(&$item) {
    $conn = mysqli_connect('localhost', 'root', '', 'photo_friends') or die($conn);
    $item = htmlentities(strip_tags(mysqli_real_escape_string($conn, $item)));
}

function sanitize($data) {
    $conn = mysqli_connect('localhost', 'root', '', 'photo_friends') or die($conn);
    $item = htmlentities(strip_tags(mysqli_real_escape_string($conn, $data)));
    return $item;
}

function output_errors($errors) {
    return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}
?>