<div class="widget">
    <h2>Hello, <?php echo $user_data['first_name']; ?>!</h2>
    <div class="inner">
        <div class="profile">
            <?php
            if (isset($_FILES['profile']) === true) {
                if (empty($_FILES['profile']['name']) === true) {
                    echo 'Please choose a file!';
                } else {
                    $allowed = array('jpg', 'jpeg', 'gif', 'png');

                    $file_name = $_FILES['profile']['name'];
                    $file_extn_temp = explode('.', $file_name);
                    $file_extn = strtolower(end($file_extn_temp));
                    $file_size = $_FILES['profile']['size'];
                    $file_error = $_FILES['profile']['error'];
                    $file_temp = $_FILES['profile']['tmp_name'];

                    if (in_array($file_extn, $allowed) === true) {
                        if ($file_error === 0) {
                            if ($file_size < 10000000) {
                                change_profile_image($session_user_id, $file_temp, $file_extn);
                                header('Location: index.php');
                                exit();
                            } else {
                                echo 'Your file is too large!';
                            }
                        } else {
                            echo 'There was an error uploading your image!';
                        }

                    } else {
                        echo 'Incorrect file type.';
                        ?>
                        <br>
                        <?php
                        echo 'Allowed: ';
                        echo implode(', ', $allowed);
                        echo '.';
                    }
                }
            }

            if (empty($user_data['profile']) === false) {
                echo '<img src="', $user_data['profile'], '" alt="', $user_data['first_name'], '\'s Profile Image">';
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="profile">
                <input type="submit">
            </form>
        </div>
        <ul>
            <li>
                <a href="logout.php">Logout</a>
            </li>
            <li>
                <a href="map.php">Map</a>
            </li>
            <li>
                <a href="<?php echo $user_data['username']; ?>">Profile</a>
            </li>
            <li>
                <a href="changepassword.php">Change Password</a>
            </li>
            <li>
                <a href="settings.php">Settings</a>
            </li>
            <?php
            global $session_user_id;
            if (has_access($session_user_id, 1) === true) {
            ?>
                <li>
                    <a href="admin.php">Admin</a>
                </li>
            <?php
            }
            if (has_access($session_user_id, 2) === true) {
            ?>
                <li>
                    <a href="moderator.php">Moderator</a>
                </li>
            <?php
            }
            ?>
        </ul
    </div>
</div>