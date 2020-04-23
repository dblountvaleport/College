<div class="widget">
    <h2>Users</h2>
    <div class="inner">
        <?php
        //Check the number of active users.
        $user_count = user_count();
        //if number of active users is greater than 1, add an 's'
        $suffix = ($user_count != 1) ? 's' : '';
        ?>
        We currently have <?php echo $user_count; ?> registered user<?php echo $suffix; ?>.
    </div>
</div>