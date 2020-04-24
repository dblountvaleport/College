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
    if (is_admin($session_user_id) === false) {
        header('Location: index.php');
        exit();
    }
}

function array_sanitize(&$item) {
    $item = htmlentities(strip_tags(/*mysql_real_escape_string*/($item)));
}

function sanitize($data) {
    return htmlentities(strip_tags(/*mysql_real_escape_string*/($data)));
}

function output_errors($errors) {
    return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}
?>