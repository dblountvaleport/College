<aside>
    <div class="widget">
    <h2>
        <?php
            echo $profile_data['first_name'];
            $text = "'s Profile";
            echo $text;
        ?>
    </h2>
    <div class="profile">
        <?php
            $name = $profile_data['first_name'];
            $extn = "'s Profile Image";
            $image = $profile_data['profile'];
        ?>
        <img src="<?php echo $profile_data['profile']; ?>" alt="<?php echo $name; echo $extn; ?>">
    </div>
    <h3>Title:</h3>
    <p><?php echo $profile_data['title'];?></p>
    <h3>Description:</h3>
    <p><?php echo $profile_data['description'];?></p>
    <h3>Contact Info:</h3>
    <p><?php echo $profile_data['email'];?></p>
</aside>
<div>
    <h2><?php echo $profile_data['first_name']; $text = "'s"; echo $text;?> Images</h2>
    <?php
    global $session_user_id;
    $user_id = user_id_from_username($username);
    $conn = mysqli_connect('localhost', 'root', '', 'photo_friends');
    $sql = "SELECT * FROM images WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    echo "<div id='img_content'>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<div id='img_div'>";
            echo "<img id='img' src='" . $row['image_location'] . "'>";
            echo "<h3>Description</h3>";
            echo "<p>" . $row['description'] . "</p>";
            $img_id = $row['id'];
            if (isset($_POST['delete'])) {
                delete_image($img_id);
                header('Location: index.php?success');
                exit();
            }
            if (has_access($session_user_id, 0) === false) {
                ?>
                    <form action="" method="post">
                        <input type="submit" name="delete" value="delete">
                    </form
                <?php
            } else {
                if ($user_id === $session_user_id) {
                    ?>
                        <form action="" method="post">
                            <input type="submit" name="delete" value="delete">
                        </form
                    <?php
                }
            }
        echo "</div>";
    }
    echo "</div>";
    echo "</div>";
    ?>
</div>
