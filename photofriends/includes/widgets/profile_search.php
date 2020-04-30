<h2>Profile Search</h2>
<div>
    <?php
        if (empty($_POST) === false && empty($errors) === true) {
                $username = ($_POST['user_name']);

            } else if (empty($errors) === false) {
                //Output Errors
                echo output_errors($errors);
            }
     ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <input type="text" name="user_name">
        </div>
        <br>
        <div>
            <input type="submit" value="Search">
        </div>
        <br>
    </form>
</div>