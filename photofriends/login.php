<?php
include 'core/init.php';

if (empty($_POST) === false) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) === true || empty($password) === true) {
        $errors[] = 'You are required to enter a username and password.';
    } else if (user_exists($username) === false) {
        $errors[] = 'We can\'t find that supplied username. Have you registered?';
    } else if (user_active($username) === false) {
        $errors[] = 'You haven\'t activated you account!';
    } else {

        if (strlen($password) > 32) {
            $error[] = 'Password too long, 32 character limit.';
        }

        $login = login($username, $password);
        if ($login === false) {
            $errors[] = 'The username/password combination is incorrect.';
        } else {
            // set the user session
            $_SESSION['user_id'] = $login;
            // redirect use to home page
            header('Location: index.php');
            exit();
        }
    }
} else {
    $errors[] = 'No data received';
}
include 'includes/overall/header.php';
if (empty($errors) === false) {
?>
    <h2>We tried to log you in, but...</h2>
<?php
    echo output_errors($errors);
}
include 'includes/overall/footer.php';
?>