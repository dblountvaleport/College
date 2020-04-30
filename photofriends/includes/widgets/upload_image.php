<h2>Upload an Image</h2>
<div class="upload_image">
    <?php
    if (isset($_FILES['images']) === true) {
        if (empty($_FILES['images']['name']) === true) {
            echo 'Please choose a file!';
        } else {
            $allowed = array('jpg', 'jpeg', 'gif', 'png');

            $file_name = $_FILES['images']['name'];
            $file_extn_temp = explode('.', $file_name);
            $file_extn = strtolower(end($file_extn_temp));
            $file_size = $_FILES['images']['size'];
            $file_error = $_FILES['images']['error'];
            $file_temp = $_FILES['images']['tmp_name'];

            $description = $_POST['text'];
            $text = strlen($description);

            if (in_array($file_extn, $allowed) === true) {
                if ($file_error === 0) {
                    if ($file_size < 10000000) {
                        if ($text < 255) {
                            user_upload_image($session_user_id, $file_temp, $file_extn, $description);
                            header('Location: index.php?uploadsuccess');
                            exit();
                        } else {
                            print_r(strlen($text));
                            die();
                            echo 'Your description is too long!';
                        }
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
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <input type="file" name="images">
        </div>
        <br>
        <div>
            <textarea name="text" cols="40" rows="4" placeholder="Say something about this image..."></textarea>
        </div>
        <div>
            <input type="submit" value="Upload">
        </div>
    </form>
</div>