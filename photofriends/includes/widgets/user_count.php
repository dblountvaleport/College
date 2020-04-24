<div class="widget">
    <h2>Users</h2>
    <div class="inner">
        <?php
        //Check the number of active users.
        $user_count = user_count();
        //if number of active users is greater than 1, add an 's'
        $suffix1 = ($user_count != 1) ? 's' : '';
        ?>
        We currently have <?php echo $user_count; ?> registered user<?php echo $suffix1; ?>.
    </div>
    <br>
    <h2>Staff</h2>
    <div class="inner">
        <?php
        //Check the number of admins & moderators.
        $admin_count = admin_count();
        $moderator_count = moderator_count();
        //if number of active admins & moderators is greater than 1, add an 's'
        $suffix2 = ($admin_count != 1) ? 's' : '';
        $suffix3 = ($moderator_count != 1) ? 's' : '';
        ?>
        We currently have <?php echo $admin_count; ?> Admin<?php echo $suffix2; ?>.
        <br>
        We currently have <?php echo $moderator_count; ?> Moderator<?php echo $suffix3; ?>.
    </div>
</div>