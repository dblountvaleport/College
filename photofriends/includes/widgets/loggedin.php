<div class="widget">
    <h2>Hello, <?php echo $user_data['first_name']; ?>!</h2>
    <div class="inner">
        <ul>
            <li>
                <a href="logout.php">Logout</a>
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