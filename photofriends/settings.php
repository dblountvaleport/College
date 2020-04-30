<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';

if (empty($_POST) === false) {
    $required_fields = array('first_name', 'email');
    foreach($_POST as $key=>$value) {
        if (empty($value) && in_array($key, $required_fields) === true) {
            $errors[] = 'Fields marked with an asterisk are required.';
            break 1;
        }
    }

    if (empty($errors) === true) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'A valid email address is required.';
        } else if (email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
            $errors[] = 'Sorry, the email \'' . $_POST['email']. '\' is already in use.';
        }
    }
}
?>

<h1>User Settings</h1>

<?php
if (isset($_GET['success']) && empty($_GET['success'])) {
    echo 'Your information been changed successfully!';
} else {
    // update user details
    if (empty($_POST) === false && empty($errors) === true) {
        $update_data = array(
            'first_name'    => $_POST['first_name'],
            'last_name'     => $_POST['last_name'],
            'email'         => $_POST['email'],
            'title'         => $_POST['title'],
            'description'   => $_POST['description']
        );

        update_user($update_data);
        header('Location: settings.php?success');
        exit();

    } else if (empty($errors) === false) {
        //Output Errors
        echo output_errors($errors);
    }
    ?>

    <form action="" method="post">
            <ul>
                <li>
                    First Name*:<br>
                    <input type="text" name="first_name" value="<?php echo $user_data['first_name']; ?>">
                </li>
                <li>
                    Last Name:<br>
                    <input type="text" name="last_name" value="<?php echo $user_data['last_name']; ?>">
                </li>
                <li>
                    Email*:<br>
                    <input type="text" name="email" value="<?php echo $user_data['email']; ?>">
                </li>
                <li>
                    Title:<br>
                    <input type="text" name="title" value="<?php echo $user_data['title']; ?>">
                </li>
                <li>
                    Description:<br>
                    <?php
                        $length = strlen($user_data['description']);
                        $description = $user_data['description'];
                        if ($length > 0){
                            $text = $description;
                        } else {
                            $text = '';
                        }
                    ?>
                    <textarea name="description" cols="40" rows="4" placeholder="Say something about yourself..."><?php echo $text;?></textarea>
                </li>
                <li>
                    <input type="submit" value="Apply Changes">
                </li>
            </ul>
        </form>

    <?php
}
include 'includes/overall/footer.php';
?>